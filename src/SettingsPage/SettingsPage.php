<?php declare( strict_types = 1 ); # -*- coding: utf-8 -*-

namespace Adminimize\SettingsPage;

class SettingsPage implements SettingsPageInterface {

	/**
	 * @var string
	 */
	private $capability;

	/**
	 * @var string
	 */
	private $slug;

	/**
	 * @var
	 */
	private $template_path;

	/**
	 * SettingsPageInterface constructor.
	 *
	 * @param $template_path
	 */
	public function __construct( $template_path ) {

		$this->template_path = $template_path;
		$this->capability = 'manage_options';
		$this->slug       = 'adminimize';
	}

	public function get_template_path() : string {

		return $this->template_path;
	}

	/**
	 * Get the allowed capability to view settings page.
	 *
	 * @return string
	 */
	public function get_capability() : string {

		return $this->capability;
	}

	/**
	 * Get the slug for the settings area.
	 *
	 * @return string
	 */
	public function get_slug() : string {

		return $this->slug;
	}
}