<?php
/**
 * @package     Albums
 * @subpackage  com_albums
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();

// Add JavaScript Frameworks.
JHtml::_('jquery.framework');

// Load the tooltip behavior script.
JHtml::_('behavior.caption');

if ($this->params->get('masonry'))
{
	// Load JavaScript.
	JHtml::script('com_albums/jquery.masonry.min.js', false, true);
	JHtml::script('com_albums/jquery.custom.js', false, true);
}

// Load JavaScript.
JHtml::script('com_albums/jquery.prettyPhoto.js', false, true);

// Load Stylesheet.
JHtml::stylesheet('com_albums/prettyPhoto.css', false, true, false);
?>
<script type="text/javascript">
	jQuery.noConflict();

	(function ($) {
		$(function () {
			// prettyPhoto.
			$(document).ready(function() {
				if ($.fn.prettyPhoto) {
					$("a[rel^=\"prettyPhoto\"]").prettyPhoto();
				}
			});
		});
	})(jQuery);
</script>
<div class="albums album-item<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading', 1)): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>

	<?php if (!$this->print): ?>
		<?php if ($canEdit || $params->get('show_print_icon', 1) || $params->get('show_email_icon', 1)): ?>
			<div class="btn-group pull-right">
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <span class="caret"></span></a>
				<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
				<ul class="dropdown-menu actions">
					<?php if ($params->get('show_print_icon', 1)): ?>
						<li class="print-icon"><?php echo JHtml::_('albumicon.print_popup', $this->item, $params); ?></li>
					<?php endif; ?>
					<?php if ($params->get('show_email_icon', 1)): ?>
						<li class="email-icon"><?php echo JHtml::_('albumicon.email', $this->item, $params); ?></li>
					<?php endif; ?>
					<?php if ($canEdit): ?>
						<li class="edit-icon"><?php echo JHtml::_('albumicon.edit', $this->item, $params); ?></li>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="pull-right">
			<?php echo JHtml::_('albumicon.print_screen', $this->item, $params); ?>
		</div>
	<?php endif; ?>

	<div class="page-header">
		<h2>
			<?php echo $this->escape($this->item->title); ?>
		</h2>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<h3><?php echo $this->escape($this->item->subtitle); ?></h3>
			<ul class="unstyled">
				<li><i class="icon-picture"></i> 561 fotos</li>
				<li><i class="icon-camera"></i> Fotográfo: Ratts</li>
			</ul>
			<!-- <a href="#" class="btn btn-info"><i class="icon-play"></i> Slideshow</a> -->
		</div>
		<div class="span6">
			<?php if ($this->item->description): ?>
				<h3><?php echo JText::_('COM_ALBUMS_HEADING_DESCRIPTION'); ?></h3>
				<div class="well well-small">
					<?php echo $this->item->description; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($this->params->get('masonry')): ?>
		<div id="images">
			<?php foreach ($this->images as $item): ?>
				<div class="box">
					<div class="thumbnail">
						<a href="<?php echo $item->url; ?>" rel="prettyPhoto[gallery1]">
							<?php echo JHtml::_('image', $item->thumbnail_url, $item->name, null, true); ?>
						</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	<?php else: ?>
		<?php $groups = array_chunk($this->images, 4); ?>
		<?php foreach ($groups as $group): ?>
			<div class="row-fluid">
				<div class="thumbnails">
					<?php foreach ($group as $item): ?>
						<div class="span3">
							<div class="thumbnail">
								<a href="<?php echo $item->url; ?>" rel="prettyPhoto[gallery1]">
									<?php echo JHtml::_('image', $item->thumbnail_url, $item->name, null, true); ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif ?>
</div>
