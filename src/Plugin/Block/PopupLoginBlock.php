<?php
/**
 * @file
 * Contains \Drupal\popup_login\Plugin\Block\ModalBlock.
 */

namespace Drupal\popup_login\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Component\Serialization\Json;

/**
 * Provides a 'Popup Login' block.
 *
 * @Block(
 *   id = "popup_login_block",
 *   admin_label = @Translation("Popup Login"),
 * )
 */
class PopupLoginBlock extends BlockBase {
	
  /**
   * {@inheritdoc}
   */
	public function build() {
		$link_url = Url::fromRoute('popup_login.modal');
		$link_url->setOptions([
			'attributes' => [
			'class' => ['use-ajax', 'button--small'],
			'data-dialog-type' => 'modal',
			'data-dialog-options' => Json::encode(['width' => 400]),
			]
		]);

		$userCurrent = \Drupal::currentUser();
		
		if($userCurrent->isAnonymous()){
			return array(
				'#type' => 'markup',
				'#markup' => Link::fromTextAndUrl(t('Login'), $link_url)->toString(),
				'#attached' => ['library' => ['core/drupal.dialog.ajax']]
			);
		}
	}
	
}






