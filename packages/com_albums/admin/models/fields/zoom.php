<?php
/**
 * @package     Albums
 * @subpackage  com_albums
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Zoom Field class for the Albums.
 *
 * @package     Albums
 * @subpackage  com_albums
 * @since       3.1
 */
class JFormFieldZoom extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var     string
	 * @since   3.1
	 */
	protected $type = 'Zoom';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   3.1
	 */
	protected function getOptions()
	{
		// Initialiase variables.
		$options = range(0, 21);

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
