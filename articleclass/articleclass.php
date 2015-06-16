<?php
/**
 * Content Plugin for Joomla! - Article Class
 *
 * @author 		Alexander Schmidt <alexander.schmidt@edvas.de>
 * @copyright 	Copyright 2015 Alexander Schmidt
 * @license 	GNU Public License version 3 or later
 * @link 		https://github.com/Bloggerschmidt
 */

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Class PlgContentArticleclass
 *
 * @since  June 2015
 */
class PlgContentArticleclass extends JPlugin
{
	protected $autoloadLanguage = true;

	/**
	 * Event method that runs on content preparation
	 *
	 * @param   JForm   $form The form object
	 * @param   integer $data The form data
	 *
	 * @return bool
	 */
	public function onContentPrepareForm($form, $data)
	{
		if (!($form instanceof JForm))
		{
			$this->_subject->setError('JERROR_NOT_A_FORM');

			return false;
		}

		$name = $form->getName();

		if (!in_array($name, array('com_content.article')))
		{
			return true;
		}

		JForm::addFormPath(__DIR__ . '/form');
		$form->loadFile('form');

		return true;
	}

	/**
	 * Event method run before content is displayed
	 *
	 * @param   string $context The context for the content passed to the plugin.
	 * @param   object &$item   The content to be displayed
	 * @param   mixed  &$params The item params
	 * @param   int	$page	Current page
	 *
	 * @return	null
	 */
	public function onContentBeforeDisplay($context, &$item, &$params, $page = 0)
	{
		$attributes = new JRegistry($item->attribs);
		$cssclass = $attributes->get('cssclass');
		$cssclass = preg_replace('/([^a-zA-Z0-9\.\-\_\ ]+)/', '', $cssclass);
		$cssclass = trim($cssclass);

		if (!empty($cssclass))
		{
			$item->introtext = '<div class="'.$cssclass.'">'.$item->introtext.'</div>';
			$item->text = '<div class="'.$cssclass.'">'.$item->text.'</div>';
		}
	}
}
