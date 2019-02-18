<?php

class Zingfit_Main_Settings {

	public function __construct() {

		$this->define_admin_hooks();
	}

	private function define_admin_hooks() {
		add_action('init', array($this, 'zingfit_admin_init'));
		add_action('admin_menu', array($this, 'zingfit_settings_page_init'));
	}

	function zingfit_admin_init() {
		$settings = get_option("zingfit_api_settings");
		if (empty($settings)) {
			$settings = array(
				'general' => [
					'zingfit_client_id' => '',
					'zingfit_client_secret' => '',
					'zingfit_tenant_id' => '',
					'zingfit_api_url' => ''
				],
			);
			add_option("zingfit_api_settings", $settings, '', 'yes');
		}
	}

	function zingfit_settings_page_init() {
		$settings_page = add_menu_page('Zingfit Settings', 'Zingfit Settings', 'manage_options', 'zingfit-settings', array($this, 'zingfit_settings_page'),'',30);

		add_action("load-{$settings_page}", array($this, 'zingfit_load_settings_page'));
	}

	function zingfit_load_settings_page() {
		if (isset($_POST["zingfit-settings-submit"]) && $_POST["zingfit-settings-submit"] == 'Y') {
			check_admin_referer("zingfit-settings-page");
			$this->zingfit_save_theme_settings();
			$url_parameters = isset($_GET['tab']) ? 'updated=true&tab=' . $_GET['tab'] : 'updated=true';
			wp_redirect(admin_url('admin.php?page=zingfit-settings&' . $url_parameters));
			exit;
		}
	}

	function zingfit_save_theme_settings() {
		global $pagenow;
		$settings = get_option("zingfit_api_settings");

		if (empty($settings)) {
			$settings = array();
		}

		if ($pagenow == 'admin.php' && $_GET['page'] == 'zingfit-settings') {
			if (isset($_GET['tab'])) {
				$tab = $_GET['tab'];
			} else {
				$tab = 'general';
      }

			switch ($tab) {

				case 'general' :
					$settings['general']['zingfit_client_id'] = $_POST['zingfit_client_id'];
					$settings['general']['zingfit_client_secret'] = $_POST['zingfit_client_secret'];
					$settings['general']['zingfit_tenant_id'] = $_POST['zingfit_tenant_id'];
					$settings['general']['zingfit_api_url'] = $_POST['zingfit_api_url'];
          break;

			}
		}

		$updated = update_option("zingfit_api_settings", $settings);
	}

	function zingfit_admin_tabs($current = 'general') {
		$tabs = array(
					'general' => 'General'
				);
		$links = array();
		echo '<div id="icon-themes" class="icon32"><br></div>';
		echo '<h2 class="nav-tab-wrapper">';
		foreach ($tabs as $tab => $name) {
			$class = ( $tab == $current ) ? ' nav-tab-active' : '';
			echo "<a class='nav-tab$class' href='?page=zingfit-settings&tab=$tab'>$name</a>";
		}
		echo '</h2>';
	}



	function zingfit_settings_page() {
		global $pagenow;
		$settings = get_option("zingfit_api_settings");
		?>

		<div class="wrap">
		  <h2>Zingfit Settings</h2>

		  <?php
		  if (isset($_GET['updated']) && 'true' == esc_attr($_GET['updated'])) {
			  echo '<div class="updated" ><p>Theme Settings updated.</p></div>';
		  }

		  if (isset($_GET['tab'])) {
			  $this->zingfit_admin_tabs($_GET['tab']);
		  } else {
			  $this->zingfit_admin_tabs('general');
		  }
		  ?>

		  <div id="poststuff">
			<form method="post" action="<?php admin_url('admin.php?page=zingfit-settings'); ?>">
				<?php
				wp_nonce_field("zingfit-settings-page");

				if ($pagenow == 'admin.php' && $_GET['page'] == 'zingfit-settings') {

					if (isset($_GET['tab'])) {
						$tab = $_GET['tab'];
					} else {
						$tab = 'general';
					}

					echo '<table class="form-table">';
					switch ($tab) {
						case 'general' :
							include 'tpl/general-settings.php';
							break;
					}
					echo '</table>';
				}
				?>
			  <p class="submit" style="clear: both;">
				<input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
				<input type="hidden" name="zingfit-settings-submit" value="Y" />
			  </p>
			</form>
		  </div>

		</div>
		<?php
	}

}
