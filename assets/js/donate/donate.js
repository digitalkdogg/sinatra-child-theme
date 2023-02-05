class Give {
  constructor() {
  	var _this = this;
  	this.vars = {'templates': {} },
  	this.stripe_utils = {

  	},
  	this.fn = {
  		'init': function () {
;
        if ($('#stripevars').val().length >0) {
           _this.vars =  JSON.parse($('#stripevars').val());
           _this.vars['rest_url'] = sinatra_vars.ajaxurl;
        }

            _this.fn.stripe();
  		},
  		'stripe_utils' : {
  			'generate_stripe_data': function () {
				_this.stripe['ownerInfo'] = {};
				_this.stripe.ownerInfo['owner'] = {};
				_this.stripe.ownerInfo.owner['address'] = {};
				_this.stripe.ownerInfo.owner['name'] = $(_this.stripe.stripeWrapper).find('input#names').val();
				_this.stripe.ownerInfo.owner.address['line1'] = $(_this.stripe.stripeWrapper).find('input#addresss').val()
				_this.stripe.ownerInfo.owner.address['city'] = $(_this.stripe.stripeWrapper).find('input#citys').val()
				_this.stripe.ownerInfo.owner.address['state'] = $(_this.stripe.stripeWrapper).find('input#states').val()
				_this.stripe.ownerInfo.owner.address['postal_code'] = $(_this.stripe.stripeWrapper).find('input#zips').val()
				_this.stripe.ownerInfo.owner['email'] = $(_this.stripe.stripeWrapper).find('input#emails').val()


			},
  			'clear_error': function () {
  				$(_this.stripe.stripeWrapper).find('.card-errors').each(function () {
  					$(this).html('');
  				})

  				$(_this.stripe.stripeWrapper).find('.error').each(function () {
  					$(this).removeClass('error');
  				})
			},
			'check_userinfo': function () {
				var isvalid = true;
				_this.fn.stripe_utils.clear_error();
				$('input.info.required').each(function () {

					if ($(this).val().length==0) {
						$(this).addClass('error');
						$('#form-wrapper .card-errors').append($(this).attr('data-msg')+'<br />');
						isvalid = false;;
					}
				})

				if (isvalid == false) {
					return false;
				}
				return true;
			},
			'check_goodtogo': function () {
				if (_this.stripe.ownerInfo != undefined) {
					if(_this.stripe.ownerInfo.owner.name.length <= 0) {
						_this.stripe.valid=false;
						$('#confirm-section .card-errors').html('Please Enter a name on the info section before confirming your donation')
						return false;
					}
					if(_this.stripe.ownerInfo.owner.email.length <= 0) {
						_this.stripe.valid=false;
						$('#confirm-section .card-errors').html('Please Enter an email on the info section before confirming your donation')
						return false;
					}
				} else {
					_this.stripe.valid=false;
					$('#confirm-section .card-errors').html('Please go to the info section and enter your info before confirming your donation')
					return false;
				}

				if (_this.stripe.amount == 0 || _this.stripe.amount == '0') {

					_this.stripe.valid=false;
					$('#confirm-section .card-errors').html('Please Enter an amount on the amount section')
					return false;
				}
				return true;
			},
			'nav_to_next': function ($this) {
				$(_this.stripe.stripeWrapper).find('.tab').each(function () {
					$(this).removeClass('active');
				})

				$('.tab-section').each(function () {
					$(this).addClass('hide');
				})


				let nextele = $($this).attr('data-next');
				let nexttab = $($this).attr('data-tab');

				$('#'+nextele).removeClass('hide');
				$('#'+nexttab+'.tab').addClass('active');
				$('#'+nexttab+'.tab').removeClass('disabled');
			},
			'check_amount': function () {
				if (_this.stripe.amount != undefined) {
					if (_this.stripe.amount == 0 || _this.stripe.amount == '0') {
						_this.stripe.valid=false;
						$('#amount-section .card-errors').html('Please Enter an amount on the amount section')
						$('#amount-section .amount-wrap').addClass('error');
						$('#confirm-section .card-errors').html('Please Enter an amount on the amount section')

						return false;
					}

					if (_this.stripe.amount.indexOf('.')>=0) {
						_this.stripe.valid=false;
						$('#amount-section .card-errors').html('Please Enter a WHOLE dollar amount')
						$('#amount-section .amount-wrap').addClass('error');
						$('#confirm-section .card-errors').html('Please Enter a WHOLE dollar amount')
						return false;
					}
				} else {
					_this.stripe.valid=false;
					$('#amount-section .card-errors').html('Please Enter an amount on the amount section')
					$('#amount-section .amount-wrap').addClass('error');
					$('#confirm-section .card-errors').html('Please Enter an amount on the amount section')
					return false;
				}

				return true;
			},
			'get_payment_intents' : function (amount) {


				$.ajax({
          'url': '../index.php/wp-json/stripe/v1/create_intent',
          'type': 'POST',
					'data': {
                  'action': 'get_stripe_intent',
                  'amount': parseInt(amount+'00'),
									'type': _this.stripe.mode,
									'name': _this.stripe.ownerInfo.owner.name,
									'email':_this.stripe.ownerInfo.owner.email,
									'address': {'line1': _this.stripe.ownerInfo.owner.address.line1,
													'city': _this.stripe.ownerInfo.owner.address.city,
													'state': _this.stripe.ownerInfo.owner.address.state,
													'postal_code': _this.stripe.ownerInfo.owner.address.postal_code
												}
									},
					'success': function (data) {
							if (data.error) {
								$('.confirm-wrapper .card-errors').html(data.error);
								_this.stripe['valid'] == false;
							} else {

								_this.stripe['payment_intent'] =  data;
								_this.stripe['valid'] = true;
								//$('button#payment').removeClass('disabled');
								_this.fn.stripe_utils.create_stripe_token();
						}
					},
					'error': function (data) {
						$('.confirm-wrapper .card-errors').html('There was an unexpected error');
					}
				})
			}, //end get_payment_intents
			'create_stripe_token': function () {
				_this.stripe.createToken(_this.stripe.card).then(function(result) {
					_this.stripe['token'] = result;
					if (result.error) {
						_this.stripe['valid'] = false;
						$('.card-errors').each(function () {
							$('#confirm-section button#submit').removeClass('spin')
							$(this).html(result.error.message);
						})
					} else {

						_this.stripe['valid'] = true;
						// Insert the token ID into the form so it gets submitted to the server
						if (result.token != undefined || result.token != '') {
							var form = document.getElementById('payment-form');
							var hiddenInput = document.createElement('input');
							hiddenInput.setAttribute('type', 'hidden');
							hiddenInput.setAttribute('name', 'stripeToken');
							hiddenInput.setAttribute('value', result.token.id);
							form.appendChild(hiddenInput);
							_this.fn.stripe_utils.create_stripe_source();

						}

					}
				});
			},
			'create_stripe_source': function () {

				_this.stripe.createSource(_this.stripe.card, _this.stripe.ownerInfo).then(function(result) {

					if (result.error) {
						// Inform the user if there was an error
						_this.stripe.valid = false;
						var errorElement = document.getElementById('card-errors');
						errorElement.textContent = result.error.message;
					} else {
						// Send the source to your server
						_this.stripe.valid = true;
						// Insert the source ID into the form so it gets submitted to the server
						var form = document.getElementById('payment-form');
						var hiddenInput = document.createElement('input');
						hiddenInput.setAttribute('type', 'hidden');
						hiddenInput.setAttribute('name', 'stripeSource');
						hiddenInput.setAttribute('value', result.source.id);
						form.appendChild(hiddenInput);
						if (result.source.status == 'chargeable') {

							if (_this.fn.stripe_utils.check_goodtogo() == true) {

								_this.stripe.valid = true;
								_this.stripe.chargable = true;
								_this.fn.stripe_utils.confirm_card_payment();
							//	$('#confirm-section button#submit').removeClass('disabled');
							}
						} else {
							_this.stripe.valid = false;
						}


					}
				}); //end stripe create source
			},
			'confirm_card_payment' : function () {
				var client_secret = _this.stripe.payment_intent.client_secret;
				_this.stripe.confirmCardPayment(
					 client_secret, {
						payment_method: {card: _this.stripe.card},
						shipping: {
											'name': _this.stripe.ownerInfo.owner.name,
											'address': {'line1': _this.stripe.ownerInfo.owner.address.line1,
																	'city': _this.stripe.ownerInfo.owner.address.city,
																	'state': _this.stripe.ownerInfo.owner.address.state,
																	'postal_code': _this.stripe.ownerInfo.owner.address.postal_code
																}
											},
						//email: 'dsfdsak@gmail.com'
					}
				).then(function(result) {
					$('#confirm-section button#submit .spinner').removeClass('spin');
          //$('#confirm-section button#submit .spinner').val('Continue');
					if (result.error) {
						$(_this.stripe.stripeWrapper).find('#confirm-section .card-errors').html('opps there was an error with your transaction');
				// Display error.message in your UI.
					} else {
						$('#confirm-section').addClass('hide');
						$('#success-wrapper').removeClass('hide');
//
						_this.stripe.amount = null;
						_this.stripe.valid = 'complete'
						$('#infotab.tab').addClass('disabled');
						$('#paymenttab.tab').addClass('disabled');
						$('#confirmtab.tab').addClass('disabled');
						$('.amount-cell.active').click();
					}
				});
			},
  		},//end stripe_utils
        'stripe': function () {

            $.getScript( "https://js.stripe.com/v3/", function( data, textStatus, jqxhr ) {

                    if (_this.vars.use_test_data == true) {
                      _this.stripe = Stripe(_this.vars.stripe_api_test_key);
                    } else {
                       _this.stripe = Stripe(_this.vars.stripe_api_live_key);
                    }


					_this.stripe.stripeWrapper = $('#stripe-api')
			//		$(_this.stripe.stripeWrapper).html(_this.vars.templates.stripe);



					_this.stripe['element_obj'] = _this.stripe.elements();

					_this.stripe['card'] = _this.stripe.element_obj.create('card', {
						'hidePostalCode': true,
						'style': {
							'base': {
								'iconColor': '#000',
								'font-size': '16px',
								'color': '#000',
								'backgroundColor': '#f7f7f7',
								'::placeholder': {
									'color': '#555',
								}
							},
							'invalid': {
								'iconColor': '#ff4f4f',
								'color': '#ff4f4f',
							}
						}
					})

					_this.stripe.card.mount('#card-element');
					$(_this.stripe.stripeWrapper).find('input#names').focus();


					$('button#submit').click(function (e) {
						e.preventDefault();

					})

					_this.stripe.card.on('change', function (event) {


						_this.fn.stripe_utils.clear_error();
						if (event.error) {
							_this.stripe.valid = false;
							$(_this.stripe.stripeWrapper).find('button#payment').addClass('disabled');
							$(_this.stripe.stripeWrapper).find('#confirmtab').addClass('disabled');
							$('#payment-section .card-errors').html(event.error.message);

						}
						if (event.complete) {
								$('button#payment').removeClass('disabled');
								_this.stripe['valid'] = true;
						}

					})

					$(_this.stripe.stripeWrapper).find('button#submit').on('click', function (e) {
						e.preventDefault();
						if ($(this).hasClass('disabled')!=true) {
							_this.fn.stripe_utils.get_payment_intents(_this.stripe.amount);
							$('#confirm-section button#submit .spinner').addClass('spin');
            	//$('#confirm-section button#submit .spinner').val('Processing');
						}

					})

					$(_this.stripe.stripeWrapper).find('.amount-cell').on('click', function () {
						$(_this.stripe.stripeWrapper).find('.amount-cell').each(function () {
							$(this).removeClass('active');
						})

						let amount = $(this).attr('data-amount');


						_this.fn.stripe_utils.clear_error();



						if ($(this).attr('data-active')=='false') {

							$(this).addClass('active');
							$(this).attr('data-active', 'true');
							$(_this.stripe.stripeWrapper).find('input#amount').val(amount);
							$(_this.stripe.stripeWrapper).find('div#amount-result').html('$'+amount)
							_this.stripe['amount'] = amount;
							_this.stripe['valid'] = true;



						} else {

							amount = 0;
							$(this).removeClass('active');
							$(this).attr('data-active', 'false');
							$(_this.stripe.stripeWrapper).find('input#amount').val(amount);
							$(_this.stripe.stripeWrapper).find('div#amount-result').html('$'+amount)
							_this.stripe['amount'] = amount;
							_this.stripe['valid'] = false;
						}

					})


					$(_this.stripe.stripeWrapper).find('input#amount').on('focus', function () {
						$(this).addClass('active')
						_this.fn.stripe_utils.clear_error();
					})

					$(_this.stripe.stripeWrapper).find(' input#amount').on('focusout', function () {
						$(this).removeClass('active');
						let amount = $(this).val();
						$(this).val(parseInt(amount));


						$('div#amount-result').html('$'+amount)
						_this.stripe.amount = amount

					})



					$(_this.stripe.stripeWrapper).find('input#amount').on('input', function () {
						_this.fn.stripe_utils.clear_error();
						$(_this.stripe.stripeWrapper).find('div#amount-result').html('$'+$(this).val())
					  	if ($(_this.stripe.stripeWrapper).find('.amount-cell.active').length > 0 ) {
								$(_this.stripe.stripeWrapper).find('.amount-cell.active').attr('data-active', false);
								$(_this.stripe.stripeWrapper).find('.amount-cell.active').removeClass('active');
						}
					})

					$(_this.stripe.stripeWrapper).find('.tab ').on('click', function () {
						if($(this).hasClass('disabled')!=true) {	_this.fn.stripe_utils.clear_error();
							$(_this.stripe.stripeWrapper).find('.tab').each(function () {
								$(this).removeClass('active');
							})
							$(this).addClass('active');

							let id = $(this).attr('data-active');
							$('.tab-section').each(function () {
								$(this).addClass('hide');
							})
							$('#'+id).removeClass('hide');
						}

					})

					$(_this.stripe.stripeWrapper).find('button.continue').on('click', function (e) {
						e.preventDefault();
						if ($(this).hasClass('disabled')!=true) {
							let nextele = $(this).attr('data-next');

							if (nextele == 'confirm-section') {

								_this.fn.stripe_utils.check_goodtogo();
								_this.stripe['unlockconfirm'] = true;
							}

							if (nextele == 'form-wrapper') {
								if (_this.fn.stripe_utils.check_amount() != false) {
									_this.fn.stripe_utils.nav_to_next(this);
								}
							} else {
								if (_this.fn.stripe_utils.check_userinfo() != false) {

									if (nextele == 'confirm-section') {
										$('#confirm-section button#submit').removeClass('disabled');
										$('#confirm-section #cardno').html('Valid');

										$(_this.stripe.stripeWrapper).find('.confirm-wrapper').find('#name').html(_this.stripe.ownerInfo.owner.name)
										$(_this.stripe.stripeWrapper).find('.confirm-wrapper').find('#address').html(_this.stripe.ownerInfo.owner.address.line1)
										$(_this.stripe.stripeWrapper).find('.confirm-wrapper').find('#city').html(_this.stripe.ownerInfo.owner.address.city)
										$(_this.stripe.stripeWrapper).find('.confirm-wrapper').find('#state').html(_this.stripe.ownerInfo.owner.address.state)
										$(_this.stripe.stripeWrapper).find('.confirm-wrapper').find('#zip').html(_this.stripe.ownerInfo.owner.address.postal_code)
										$(_this.stripe.stripeWrapper).find('.confirm-wrapper').find('#email').html(_this.stripe.ownerInfo.owner.email)



									}
									_this.fn.stripe_utils.nav_to_next(this);
								}
							}

						}
					});


					$(_this.stripe.stripeWrapper).find('input.info').on('change', function () {
						let resultele = $(this).attr('data-result');
						$(_this.stripe.stripWrapper).find('#confirm-section #'+resultele).text($(this).val())

						_this.fn.stripe_utils.generate_stripe_data();
					})

					})
            }
  	}

  }//end constructor
}//end class

$(document).ready(function () {
	const give = new Give();
    give.fn.init();

    php_vars = null;
})
