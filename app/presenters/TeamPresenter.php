<?php

/**
 * Team presenter.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class TeamPresenter extends NPresenter
{
        private $teams;

        private $groups;

        private $results;
        
        public function renderDefault()
        {
                
        }
        
        public function renderNew($id = 0)
        {
        }

        public function renderList($id = 0)
        {
                if ($id === 0)
                        return $this->renderDefault();

                $this->teams = $this->getService('model')->getTeams();

                $row = $this->teams->get($id);
                if(!$row) {
                        throw new NBadRequestException('Team not found');
                }
                $this->template->team = $row;
 
                $this->template->groups = $this->getService('model')->getGroups();

        }


	protected function createComponentTeamForm()
	{

                $events = $this->getService('model')->getEvents();
                $groups = array();
                foreach($events as $event){
                        $g = $this->getService('model')->getGroups()->where('eventID', $event->id);
                        foreach ($g as $group) {
                                $groups[$group->id] = $event->name . " - " . $group->name;
                        }
                }

		$form = new NAppForm;
		$form->addText('name', 'Name of the team:')
			->setRequired('Please provide a name.');
                
                $select = $form->addSelect('groupID', 'Group:', $groups)
                        ->setDefaultValue((int) $this->getParam('id'));

		$form->addSubmit('send', 'Create');

		$form->onSuccess[] = callback($this, 'teamFormSubmitted');
		return $form;
	}
        
        public function teamFormSubmitted($form)
        {
                $this->teams = $this->getService('model')->getTeams();

                $this->results = $this->getService('model')->getResults();

                if ($form['send']->isSubmittedBy()) {
                        $row = (int) $this->getParam('id');
                        $values = $form->getValues();
                        $action = $this->getParam('action');

                        if($action == 'edit') {
                                $this->teams->find($row)->update($values);
                                $this->flashMessage("Team '{$values->name}' saved.");
                        } else {
                                $team = $this->teams->find($row)->insert($values);

                                $result = array();
                                //TODO: last insert ID
                                $result['teamID'] = $team->id; 
                                $result['wins'] = 0;
                                $result['loses'] = 0;
                                $result['draws'] = 0;
                                $result['score'] = 0;
                                $result['groupID'] = $values->groupID;
                                
                                $this->results->insert($result);

                                $this->flashMessage("Team '{$values->name}' created.");
                        }
                        

                        $this->redirect('Dashboard:');
                }
                
        }

}
