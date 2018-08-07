<?php

/**
 * @file
 * CustomModalController class.
 */

namespace Drupal\popup_login\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Form\FormBuilder;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PopupLoginController extends ControllerBase {
	
	/**
	 * The form buidler service
	 *
	 * @var \Drupal\Core\Form\FormBuilder
	 */
	protected $formBuilder;
	
	public static function create(ContainerInterface $container){
		return new static(
			$container->get('form_builder')
		);
	}
	
	/**
	 * Constructs the PopupLoginController object
	 *
	 * @param \Drupal\Core\Form\FormBuilder $formBuilder
	 *   The form builder service
	 */
	public function __construct(FormBuilder $formBuilder){
		$this->formBuilder = $formBuilder;
	}

	public function modal() {
		$options = [
			'dialogClass' => 'popup-dialog-class',
			'width' => '430px',
		];
		$response = new AjaxResponse();
		$modal_form = $this->formBuilder->getForm('Drupal\user\Form\UserLoginForm');
		$response->addCommand(new OpenModalDialogCommand('Login Form', $modal_form, $options));

		return $response;
	}
}




