<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Loaders
 */



/**
 * Nette auto loader is responsible for loading Nette classes and interfaces.
 *
 * @author     David Grudl
 * @package Nette\Loaders
 */
class NNetteLoader extends NAutoLoader
{
	/** @var NNetteLoader */
	private static $instance;

	/** @var array */
	public $list = array(
		'argumentoutofrangeexception' => '/common/exceptions.php',
		'deprecatedexception' => '/common/exceptions.php',
		'directorynotfoundexception' => '/common/exceptions.php',
		'fatalerrorexception' => '/common/exceptions.php',
		'filenotfoundexception' => '/common/exceptions.php',
		'iannotation' => '/Reflection/IAnnotation.php',
		'iauthenticator' => '/Security/IAuthenticator.php',
		'iauthorizator' => '/Security/IAuthorizator.php',
		'ibarpanel' => '/Diagnostics/IBarPanel.php',
		'icachejournal' => '/Caching/Storages/IJournal.php',
		'icachestorage' => '/Caching/IStorage.php',
		'icomponent' => '/ComponentModel/IComponent.php',
		'icomponentcontainer' => '/ComponentModel/IContainer.php',
		'iconfigadapter' => '/Config/IAdapter.php',
		'idicontainer' => '/DI/IContainer.php',
		'ifiletemplate' => '/Templating/IFileTemplate.php',
		'iformcontrol' => '/Forms/IControl.php',
		'iformrenderer' => '/Forms/IFormRenderer.php',
		'ifreezable' => '/common/IFreezable.php',
		'ihttprequest' => '/Http/IRequest.php',
		'ihttpresponse' => '/Http/IResponse.php',
		'iidentity' => '/Security/IIdentity.php',
		'imacro' => '/Latte/IMacro.php',
		'imailer' => '/Mail/IMailer.php',
		'invalidstateexception' => '/common/exceptions.php',
		'ioexception' => '/common/exceptions.php',
		'ipresenter' => '/Application/IPresenter.php',
		'ipresenterfactory' => '/Application/IPresenterFactory.php',
		'ipresenterresponse' => '/Application/IResponse.php',
		'ireflection' => '/Database/IReflection.php',
		'irenderable' => '/Application/UI/IRenderable.php',
		'iresource' => '/Security/IResource.php',
		'irole' => '/Security/IRole.php',
		'irouter' => '/Application/IRouter.php',
		'isessionstorage' => '/Http/ISessionStorage.php',
		'isignalreceiver' => '/Application/UI/ISignalReceiver.php',
		'istatepersistent' => '/Application/UI/IStatePersistent.php',
		'isubmittercontrol' => '/Forms/ISubmitterControl.php',
		'isupplementaldriver' => '/Database/ISupplementalDriver.php',
		'itemplate' => '/Templating/ITemplate.php',
		'itranslator' => '/Localization/ITranslator.php',
		'iuser' => '/Http/IUser.php',
		'memberaccessexception' => '/common/exceptions.php',
		'micropresenter' => '/Application/MicroPresenter.php',
		'nabortexception' => '/Application/exceptions.php',
		'nannotation' => '/Reflection/Annotation.php',
		'nannotationsparser' => '/Reflection/AnnotationsParser.php',
		'nappform' => '/Application/UI/Form.php',
		'napplication' => '/Application/Application.php',
		'napplicationexception' => '/Application/exceptions.php',
		'narrayhash' => '/common/ArrayHash.php',
		'narraylist' => '/common/ArrayList.php',
		'narrays' => '/Utils/Arrays.php',
		'nassertionexception' => '/Utils/Validators.php',
		'nauthenticationexception' => '/Security/AuthenticationException.php',
		'nautoloader' => '/Loaders/AutoLoader.php',
		'nbadrequestexception' => '/Application/exceptions.php',
		'nbadsignalexception' => '/Application/UI/BadSignalException.php',
		'nbutton' => '/Forms/Controls/Button.php',
		'ncache' => '/Caching/Cache.php',
		'ncachemacro' => '/Latte/Macros/CacheMacro.php',
		'ncachinghelper' => '/Caching/OutputHelper.php',
		'ncallback' => '/common/Callback.php',
		'ncfix' => '/loader.php',
		'ncheckbox' => '/Forms/Controls/Checkbox.php',
		'nclassreflection' => '/Reflection/ClassType.php',
		'nclirouter' => '/Application/Routers/CliRouter.php',
		'ncomponent' => '/ComponentModel/Component.php',
		'ncomponentcontainer' => '/ComponentModel/Container.php',
		'nconfigcompiler' => '/Config/Compiler.php',
		'nconfigcompilerextension' => '/Config/CompilerExtension.php',
		'nconfighelpers' => '/Config/Helpers.php',
		'nconfiginiadapter' => '/Config/Adapters/IniAdapter.php',
		'nconfigloader' => '/Config/Loader.php',
		'nconfigneonadapter' => '/Config/Adapters/NeonAdapter.php',
		'nconfigphpadapter' => '/Config/Adapters/PhpAdapter.php',
		'nconfigurator' => '/Config/Configurator.php',
		'nconnection' => '/Database/Connection.php',
		'nconstantsextension' => '/Config/Extensions/ConstantsExtension.php',
		'ncontrol' => '/Application/UI/Control.php',
		'nconventionalreflection' => '/Database/Reflection/ConventionalReflection.php',
		'ncoremacros' => '/Latte/Macros/CoreMacros.php',
		'ndatabasepanel' => '/Database/Diagnostics/ConnectionPanel.php',
		'ndatetime53' => '/common/DateTime.php',
		'ndebugbar' => '/Diagnostics/Bar.php',
		'ndebugbluescreen' => '/Diagnostics/BlueScreen.php',
		'ndebugger' => '/Diagnostics/Debugger.php',
		'ndebughelpers' => '/Diagnostics/Helpers.php',
		'ndefaultbarpanel' => '/Diagnostics/DefaultBarPanel.php',
		'ndefaultformrenderer' => '/Forms/Rendering/DefaultFormRenderer.php',
		'ndevnullstorage' => '/Caching/Storages/DevNullStorage.php',
		'ndicontainer' => '/DI/Container.php',
		'ndicontainerbuilder' => '/DI/ContainerBuilder.php',
		'ndihelpers' => '/DI/Helpers.php',
		'ndinestedaccessor' => '/DI/NestedAccessor.php',
		'ndiscoveredreflection' => '/Database/Reflection/DiscoveredReflection.php',
		'ndiservicedefinition' => '/DI/ServiceDefinition.php',
		'ndistatement' => '/DI/Statement.php',
		'nenvironment' => '/common/Environment.php',
		'nextensionreflection' => '/Reflection/Extension.php',
		'nfilejournal' => '/Caching/Storages/FileJournal.php',
		'nfileresponse' => '/Application/Responses/FileResponse.php',
		'nfilestorage' => '/Caching/Storages/FileStorage.php',
		'nfiletemplate' => '/Templating/FileTemplate.php',
		'nfinder' => '/Utils/Finder.php',
		'nfirelogger' => '/Diagnostics/FireLogger.php',
		'nforbiddenrequestexception' => '/Application/exceptions.php',
		'nform' => '/Forms/Form.php',
		'nformcontainer' => '/Forms/Container.php',
		'nformcontrol' => '/Forms/Controls/BaseControl.php',
		'nformgroup' => '/Forms/ControlGroup.php',
		'nformmacros' => '/Latte/Macros/FormMacros.php',
		'nforwardresponse' => '/Application/Responses/ForwardResponse.php',
		'nframework' => '/common/Framework.php',
		'nfreezableobject' => '/common/FreezableObject.php',
		'nfunctionreflection' => '/Reflection/GlobalFunction.php',
		'ngenericrecursiveiterator' => '/Iterators/Recursor.php',
		'ngroupedtableselection' => '/Database/Table/GroupedSelection.php',
		'nhiddenfield' => '/Forms/Controls/HiddenField.php',
		'nhtml' => '/Utils/Html.php',
		'nhtmlnode' => '/Latte/HtmlNode.php',
		'nhttpcontext' => '/Http/Context.php',
		'nhttprequest' => '/Http/Request.php',
		'nhttprequestfactory' => '/Http/RequestFactory.php',
		'nhttpresponse' => '/Http/Response.php',
		'nhttpuploadedfile' => '/Http/FileUpload.php',
		'nidentity' => '/Security/Identity.php',
		'nimage' => '/common/Image.php',
		'nimagebutton' => '/Forms/Controls/ImageButton.php',
		'ninstancefilteriterator' => '/Iterators/InstanceFilter.php',
		'ninvalidlinkexception' => '/Application/UI/InvalidLinkException.php',
		'ninvalidpresenterexception' => '/Application/exceptions.php',
		'njson' => '/Utils/Json.php',
		'njsonexception' => '/Utils/Json.php',
		'njsonresponse' => '/Application/Responses/JsonResponse.php',
		'nlatteexception' => '/Latte/ParseException.php',
		'nlattefilter' => '/Latte/Engine.php',
		'nlimitedscope' => '/Utils/LimitedScope.php',
		'nlink' => '/Application/UI/Link.php',
		'nlogger' => '/Diagnostics/Logger.php',
		'nmacronode' => '/Latte/MacroNode.php',
		'nmacroset' => '/Latte/Macros/MacroSet.php',
		'nmacrotokenizer' => '/Latte/MacroTokenizer.php',
		'nmail' => '/Mail/Message.php',
		'nmailmimepart' => '/Mail/MimePart.php',
		'nmapiterator' => '/Iterators/Mapper.php',
		'nmemcachedstorage' => '/Caching/Storages/MemcachedStorage.php',
		'nmemorystorage' => '/Caching/Storages/MemoryStorage.php',
		'nmethodreflection' => '/Reflection/Method.php',
		'nmimetypedetector' => '/Utils/MimeTypeDetector.php',
		'nmissingserviceexception' => '/DI/exceptions.php',
		'nmssqldriver' => '/Database/Drivers/MsSqlDriver.php',
		'nmultiplier' => '/Application/UI/Multiplier.php',
		'nmultiselectbox' => '/Forms/Controls/MultiSelectBox.php',
		'nmysqldriver' => '/Database/Drivers/MySqlDriver.php',
		'nncallbackfilteriterator' => '/Iterators/Filter.php',
		'nneon' => '/Utils/Neon.php',
		'nneonentity' => '/Utils/Neon.php',
		'nneonexception' => '/Utils/Neon.php',
		'nnetteextension' => '/Config/Extensions/NetteExtension.php',
		'nnetteloader' => '/Loaders/NetteLoader.php',
		'nnrecursivecallbackfilteriterator' => '/Iterators/RecursiveFilter.php',
		'nobject' => '/common/Object.php',
		'nobjectmixin' => '/common/ObjectMixin.php',
		'nocidriver' => '/Database/Drivers/OciDriver.php',
		'nodbcdriver' => '/Database/Drivers/OdbcDriver.php',
		'notimplementedexception' => '/common/exceptions.php',
		'notsupportedexception' => '/common/exceptions.php',
		'npaginator' => '/Utils/Paginator.php',
		'nparameterreflection' => '/Reflection/Parameter.php',
		'nparser' => '/Latte/Parser.php',
		'npermission' => '/Security/Permission.php',
		'npgsqldriver' => '/Database/Drivers/PgSqlDriver.php',
		'nphpclasstype' => '/Utils/PhpGenerator/ClassType.php',
		'nphpextension' => '/Config/Extensions/PhpExtension.php',
		'nphpfilestorage' => '/Caching/Storages/PhpFileStorage.php',
		'nphphelpers' => '/Utils/PhpGenerator/Helpers.php',
		'nphpliteral' => '/Utils/PhpGenerator/PhpLiteral.php',
		'nphpmethod' => '/Utils/PhpGenerator/Method.php',
		'nphpparameter' => '/Utils/PhpGenerator/Parameter.php',
		'nphpproperty' => '/Utils/PhpGenerator/Property.php',
		'nphpwriter' => '/Latte/PhpWriter.php',
		'npresenter' => '/Application/UI/Presenter.php',
		'npresentercomponent' => '/Application/UI/PresenterComponent.php',
		'npresentercomponentreflection' => '/Application/UI/PresenterComponentReflection.php',
		'npresenterfactory' => '/Application/PresenterFactory.php',
		'npresenterrequest' => '/Application/Request.php',
		'npropertyreflection' => '/Reflection/Property.php',
		'nradiolist' => '/Forms/Controls/RadioList.php',
		'nrecursivecomponentiterator' => '/ComponentModel/RecursiveComponentIterator.php',
		'nredirectresponse' => '/Application/Responses/RedirectResponse.php',
		'nregexpexception' => '/Utils/Strings.php',
		'nrobotloader' => '/Loaders/RobotLoader.php',
		'nroute' => '/Application/Routers/Route.php',
		'nroutelist' => '/Application/Routers/RouteList.php',
		'nroutingdebugger' => '/Application/Diagnostics/RoutingPanel.php',
		'nrow' => '/Database/Row.php',
		'nrule' => '/Forms/Rule.php',
		'nrules' => '/Forms/Rules.php',
		'nsafestream' => '/Utils/SafeStream.php',
		'nselectbox' => '/Forms/Controls/SelectBox.php',
		'nsendmailmailer' => '/Mail/SendmailMailer.php',
		'nservicecreationexception' => '/DI/exceptions.php',
		'nsession' => '/Http/Session.php',
		'nsessionsection' => '/Http/SessionSection.php',
		'nsimpleauthenticator' => '/Security/SimpleAuthenticator.php',
		'nsimplerouter' => '/Application/Routers/SimpleRouter.php',
		'nsmartcachingiterator' => '/Iterators/CachingIterator.php',
		'nsmtpexception' => '/Mail/SmtpMailer.php',
		'nsmtpmailer' => '/Mail/SmtpMailer.php',
		'nsqlite2driver' => '/Database/Drivers/Sqlite2Driver.php',
		'nsqlitedriver' => '/Database/Drivers/SqliteDriver.php',
		'nsqlliteral' => '/Database/SqlLiteral.php',
		'nsqlpreprocessor' => '/Database/SqlPreprocessor.php',
		'nstatement' => '/Database/Statement.php',
		'nstaticclassexception' => '/common/exceptions.php',
		'nstrings' => '/Utils/Strings.php',
		'nsubmitbutton' => '/Forms/Controls/SubmitButton.php',
		'ntablerow' => '/Database/Table/ActiveRow.php',
		'ntableselection' => '/Database/Table/Selection.php',
		'ntemplate' => '/Templating/Template.php',
		'ntemplateexception' => '/Templating/FilterException.php',
		'ntemplatehelpers' => '/Templating/DefaultHelpers.php',
		'ntextarea' => '/Forms/Controls/TextArea.php',
		'ntextbase' => '/Forms/Controls/TextBase.php',
		'ntextinput' => '/Forms/Controls/TextInput.php',
		'ntextresponse' => '/Application/Responses/TextResponse.php',
		'ntokenizer' => '/Utils/Tokenizer.php',
		'ntokenizerexception' => '/Utils/Tokenizer.php',
		'nuimacros' => '/Latte/Macros/UIMacros.php',
		'nunknownimagefileexception' => '/common/Image.php',
		'nuploadcontrol' => '/Forms/Controls/UploadControl.php',
		'nurl' => '/Http/Url.php',
		'nurlscript' => '/Http/UrlScript.php',
		'nuser' => '/Http/User.php',
		'nvalidators' => '/Utils/Validators.php',
	);



	/**
	 * Returns singleton instance with lazy instantiation.
	 * @return NNetteLoader
	 */
	public static function getInstance()
	{
		if (self::$instance === NULL) {
			self::$instance = new self;
		}
		return self::$instance;
	}



	/**
	 * Handles autoloading of classes or interfaces.
	 * @param  string
	 * @return void
	 */
	public function tryLoad($type)
	{
		$type = ltrim(strtolower($type), '\\');
		if (isset($this->list[$type])) {
			NLimitedScope::load(NETTE_DIR . $this->list[$type], TRUE);
			self::$count++;
		}
	}

}
