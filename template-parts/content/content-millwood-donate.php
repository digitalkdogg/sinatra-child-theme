<?php
/**
 * Template part for displaying content of Sinatra Canvas [Fullwidth] page template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sinatra
 * @author  Sinatra Team <hello@sinatrawp.com>
 * @since   1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php sinatra_schema_markup( 'article' ); ?>>
	<div class="entry-content si-entry si-donation-entry" id = "stripe-api">
		<?php
		do_action( 'sinatra_before_page_content' );

		the_content(); ?>
		<form method="post" id="payment-form" data-next="form-wrapper" class = "margin-l-r-20-desktop-per">
		  <div id = "tabwrapper" class = "flex space-around">
		      <div class = "tab active text-align-center" id = "amounttab" data-active="amount-section">Amount</div>
		      <div class = "tab text-align-center disabled" id = "infotab" data-active = "form-wrapper">Info</div>
		      <div class = "tab text-align-center disabled" id = "paymenttab" data-active = "payment-section">Payment</div>
		      <div class = "tab text-align-center disabled" id = "confirmtab" data-active = "confirm-section">Confirm</div>

		    </div>
		<br /><br />
		  <div id = "amount-section" class ="tab-section margin-l-r-5-per">
		      <div class = "columns small-12">Chose An Amount Or Enter Your Own Amount :</div>
		      <hr />
		      <div class = "amount-wrap">
		        <div class = "flex space-between flex-column-mobile">
		          <div class = "columns small-3 amount-cell text-align-center" data-amount = "5" data-active="false">$5</div>
		          <div class = "columns small-3 amount-cell text-align-center" data-amount = "25" data-active="false">$25</div>
		          <div class = "columns small-3 amount-cell text-align-center" data-amount = "50" data-active="false">$50</div>
		          <div class = "columns small-3"></div>
		        </div>
		        <div class = "flex space-between flex-column-mobile">
		          <div class = "columns small-3 amount-cell text-align-center" data-amount = "100" data-active="false">$100</div>
		          <div class = "columns small-3 amount-cell text-align-center" data-amount = "250" data-active="false">$250</div>
		          <div class = "columns small-3 amount-cell text-align-center" data-amount = "500" data-active="false">$500</div>
		          <div class = "columns small-3"></div>
		        </div>
		        <hr />
		        <div style = "text-align:center; font-size:2em; font-weight: bold; margin-bottom:10px">OR</div>
		        <div class = "flex flex-center" style = "align-items: center;">
		          <div class = "columns small-4 text-align-center" style = "margin-right:20px;">Enter Amount (Whole Amount):</div>
		          <div class = "columns small-4 custom-amount-cell text-align-center" data-amount = "">
		                <input type = "number" id="amount" name = "amount" step = "1" min="1" class = "text-align-right"/>

		          </div>
		          <div class = "columns small-4 decimal">.00</div>
		        </div><br />
		      </div>
		      <div class="card-errors" role="alert"></div>
		      <br />
		      <div class = "form-row row text-align-right">

		        <button data-next="form-wrapper" data-tab="infotab" class = "btn continue">
		          <div class="spinner">
		            <div class="double-bounce1"></div>
		            <div class="double-bounce2"></div>
		          </div>
		          Continue
		          </button>
							<br /><br />
		      </div>
		  </div>
		  <div class = "form-wrapper hide tab-section margin-l-r-5-per" id = "form-wrapper">
		    <div class = "columns small-12">Please tell us about yourself :</div>
		    <hr />
		    <div class = "flex flex-start flex-basis">
		      <div class = "columns">
						<label for ="names" class = "columns small-4 large-3">Name *</label>
					</div>
		      <div class = "columns small-8 large-9">
		        <input id = "names" name="names" type = "text" class="required info"
		            data-msg = "Please enter a name" data-result="name" />
		        </div>
		    </div>
		    <div class = "flex flex-start flex-basis">
					  <div class = "columns">
		          <label for ="emails" class = "columns small-4 large-3">Email *</label>
						</div>
		          <div class = "columns small-8 large-9">
		            <input id = "emails" name="emails" type = "text" class = "required info"
		            data-msg = "Please enter an email" data-result="email" />
		            </div>
		    </div>
		    <div class = "flex flex-start flex-basis">
					  <div class = "columns">
		        	<label for ="addresss" class = "columns small-4 large-3">Address</label>
						</div>
		        <div class = "columns small-8 large-9">
		          <input id = "addresss" name="addresss" type = "text" class = "info"
		          data-result="address" />
		          </div>
		    </div>
		    <div class = "flex flex-start flex-basis">
						  <div class = "columns">
		        		<label for ="citys" class = "columns small-4 large-3">City</label>
							</div>
		        <div class = "columns small-8 large-9">
		          <input id = "citys" name="citys" type = "text" class="info"
		          data-result="city" />
		          </div>
		    </div>
		    <div class = "flex flex-start flex-basis">
					<div class = "columns">
		        	<label for = "state" class = "columns small-4 large-3">State</label>
					</div>
		        <div class = "columns small-8 large-9">
		          <input id = "states" name = "states" type = "text" class="info"
		          data-result="state" />
		        </div>
		      </div>
		      <div class = "flex flex-start flex-basis">
						<div class = "columns">
		        	<label for = "zip" class = "columns small-4 large-3">zip</label>
						</div>
		        <div class = "columns small-4  large-5">
		          <input id = "zips"  name="zips" type = "text" class="info"
		          data-result="zip" />
		        </div>
		        <div class="columns small-4 large-4"></div>
		    </div>
		    <br />
		    <div class="card-errors" role="alert"></div>
		    <br />
		    <div class = "form-row row text-align-right">
					<p>* = field is required</p>
		      <button data-next="payment-section" data-tab="paymenttab" class = "btn continue">
		        <div class="spinner">
		          <div class="double-bounce1"></div>
		          <div class="double-bounce2"></div>
		        </div>
		        Continue
		        </button>
		    </div>

		  </div>

		    <div class = "payment-wrapper hide min-height-400 tab-section margin-l-r-5-per" id = "payment-section">
		      <div class = "columns small-12">The important stuff your payment information :</div>

		      <hr />
		      <label for="card-element">
		        Credit or debit card
		      </label>
		      <div id="card-element">
		        <!-- a Stripe Element will be inserted here. -->
		      </div>

		      <!-- Used to display form errors -->
		      <div class="card-errors" role="alert"></div>


		      <div id = "blank" class = "min-height-200"></div>
		      <div class = "form-row row text-align-right">
		        <button data-next="confirm-section" data-tab="confirmtab" class = "btn continue disabled" id = "payment">
		          <div class="spinner">
		            <div class="double-bounce1"></div>
		            <div class="double-bounce2"></div>
		          </div>
		          Continue
		          </button>
		      </div>

		    </div>



		    <div class = "confirm-wrapper hide min-height-400 tab-section margin-l-r-5-per" id = "confirm-section">
		      <div class = "columns small-12">Is this information correct :</div>
		      <hr />
		        <div class = "results min-height-400">
		          <div class = "flex flex-start flex-basis">
		              <div class="small-4 large-3 columns"><b>Name:</b> </div>
		            <div id ="name" class="small-8 large-9 columns"></div>
		        </div>
		        <div class = "flex flex-start flex-basis">
		            <div class="small-4 large-3 columns"><b>Address:</b></div>
		            <div class="small-8 large-9 columns" id = "address"></div>
		        </div>
		          <div class = "flex flex-start flex-basis">
		              <div class="small-4 large-3 columns"><b>City:</b> </div>
		              <div id = "city" class = "small-8 large-9 columns"></div>
		          </div>
		          <div class = "flex flex-start flex-basis">
		              <div class="small-4 large-3 columns"><b>State:</b> </div>
		              <div id = "state" class = "small-8 large-9 columns"></div>
		          </div>
		          <div class = "flex flex-start flex-basis">
		              <div class="small-4 large-3 columns"><b>Zip:</b> </div>
		              <div id = "zip" class="small-8 large-9 columns"></div>
		            </div>
		          <div class = "flex flex-start flex-basis">
		              <div class="small-4 large-3 columns"><b>Email:</b> </div>
		              <div class="small-8 large-9 columns" id = "email"></div>
		            </div>
		            <div class = "flex flex-start flex-basis">
		                <div class="small-4 large-3 columns"><b>Credit Card:</b> </div>
		                <div class="small-8 large-9 columns" id = "cardno"></div>
		              </div>
		            <div class = "flex flex-center flex-basis amount">
		                <div class="small-12 large-12 columns text-align-center padding-20" id = "amount-result">$0</div>
		            </div>
		            </div>
		            <br />
		            <div class="card-errors" role="alert"></div>
		            <br />
		        <div class = "row">
		          <div class = "columns small-12 text-align-right">
		            <button id = "submit" class = "btn disabled">
		              <div class="spinner">
		                <div class="double-bounce1"></div>
		                <div class="double-bounce2"></div>
		              </div>
		              Confirm Donation
		            </button>
		            </div>

		          </div>
		      </div>
		      <div class = "success-wrapper hide min-height-400 text-align-center tab-section margin-l-r-5-per" id = "success-wrapper">
		        <div id = "success" style="">
		            <div class = "icon-check dashicons dashicons-saved" />
		          </div>
		          <div id = "success-sub-wrap">
		        <p>Thank you for your support in our community</p>
		        <p>Feel free to leave this page at any time.</p>
		        <button onClick="window.location.reload();" class = "btn">Make Another Donation</button>
		        </div>
		      </div>
<input type = "hidden" id = "stripevars" value = "<?php echo htmlspecialchars(get_stripe_var()); ?>" />
		</form>

<?php
		do_action( 'sinatra_after_page_content' );
		?>
	</div><!-- END .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
