<?php

/**
 * @file user-profile.tpl.php
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * By default, all user profile data is printed out with the $user_profile
 * variable. If there is a need to break it up you can use $profile instead.
 * It is keyed to the name of each category or other data attached to the
 * account. If it is a category it will contain all the profile items. By
 * default $profile['summary'] is provided which contains data on the user's
 * history. Other data can be included by modules. $profile['user_picture'] is
 * available by default showing the account picture.
 *
 * Also keep in mind that profile items and their categories can be defined by
 * site administrators. They are also available within $profile. For example,
 * if a site is configured with a category of "contact" with
 * fields for of addresses, phone numbers and other related info, then doing a
 * straight print of $profile['contact'] will output everything in the
 * category. This is useful for altering source order and adding custom
 * markup for the group.
 *
 * To check for all available data within $profile, use the code below.
 * @code
 *   print '<pre>'. check_plain(print_r($profile, 1)) .'</pre>';
 * @endcode
 *
 * Available variables:
 *   - $user_profile: All user profile data. Ready for print.
 *   - $profile: Keyed array of profile categories and their items or other data
 *     provided by modules.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 */

/*
return array(
    'user_profile_form' => array(
      // Forms always take the form argument.
      'arguments' => array('form' => NULL),
      'render element' => 'form',
      'template' => 'templates/user-profile-edit',
    ),
  );
  
  return array(
    'custom_links' => array( 
      'variables' => array('links' => NULL, 'attributes' => NULL, 'heading' => NULL),
    ),
    'some_menu' => array(
      'variables' => array('menu' => NULL),
    ),
   'user_profile_form' => array(
      // Forms always take the form argument.
      'arguments' => array('form' => NULL),
      'render element' => 'form',
      'template' => 'templates/user-profile-edit',
    ),
  );
*/

// $user_profile->field_first_name[$account->language][0]['value'];
$uid = (int)$user_profile['field_enroller_id']['#object']->uid;
$account = user_load($uid);

$firstName = $account->field_first_name[key($account->field_first_name)][0]['value'];
$lastName = $account->field_last_name[key($account->field_last_name)][0]['value'];
$username = $account->name;
$status = $account->status[key($account->status)][0]['value'];
$status = $account->status[key($account->status)][0]['value'];
$cusSince = $account->created[key($account->created)][0]['value'];
$phoneNumber = $account->field_phone[key($account->field_phone)][0]['value'];
$email = $account->mail;
$shipping_address = $account->field_shipping_address[key($account->field_shipping_address)][0];
?>

<form action="/user/<?= $uid; ?>/edit" enctype="multipart/form-data" method="post" id="user-edit-<?php print $user->uid; ?>" accept-charset="UTF-8" class="profile">
<input type="hidden" name="form_build_id" value="<?php print render($form['form_build_id']); ?>">
<input type="hidden" name="form_token" value="<?php print render($form['form_token']); ?>">
<input type="hidden" name="form_id" value="<?php print render($form['form_id']); ?>">

	<div class="col-sm-3">
		<h1>Welcome, <br/><em><?php echo "$firstName $lastName"; ?></em>!</h1>
		
		<ul id="sideMenu">
			<li>My Profile
				<ul>
					<li><a href="#accountSettings">Account Settings</a></li>
					<li><a href="/user/<?= $uid; ?>/addressbook">Address Book</a></li>
					<li><a href="/user/<?= $uid; ?>/cards">Payment Information</a></li>
					<!-- <li><a href="#">Social Media</a></li> -->
				</ul>
			</li>
			<li><a href="/user/<?= $uid; ?>/orders">My Orders</a></li>
			<li>My Replenishments</li>
			<li>My Rewards</li>
			<li>My Parties
				<ul>
					<li><a href="/host_program/new_host_party">Create a New Party</a></li>
					<li><a href="/host_program">Manage My Parties</a></li>
					<li><a href="host_program/guestbook">Guestbook</a></li>
				</ul>
			</li>
			<li>Refer a Friend</li>
			<li>Online Chat</li>
		</ul>
	
	</div>
	<div class="col-sm-9" id="accountContainer">
		<div class="row" id="accountSettings">
			<div class="page-header col-xs-12">
  				<h1>Account Settings</h1>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Account Number</label>
				<div class="col-sm-9"> <?= $uid; ?></div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Customer Status</label>
				<div class="col-sm-9"> <?php if( $status == 1 ) { echo 'Preferred'; } else { echo 'Not Preferred';} ?></div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Customer Since</label>
				<div class="col-sm-9"> <?= date("m/d/Y", $cusSince); ?> </div>
			</div>
			
			<div class="col-xs-12 row">
				<label class="col-sm-3">First Name</label>
				<div class="col-sm-9 input-group"> <input type="text" class="form-control" value="<?= $firstName; ?>" placeholder="<?= $firstName; ?>" id="edit-first_name" name="first_name"> </div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Last Name</label>
				<div class="col-sm-9 input-group"> <input type="text" class="form-control" value="<?= $lastName; ?>" placeholder="<?= $lastName; ?>"> </div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Username</label>
				<div class="col-sm-9 input-group"> <input type="text" class="form-control" value="<?= $username; ?>" placeholder="<?= $username; ?>"> </div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Password</label>
				<div class="col-sm-9 input-group"> <input type="password" class="form-control" value="password" placeholder="password"> <a href="#" class="input-group-addon">Change my password</a> </div>
			</div>
		</div>

		<div class="row">
			<div class="page-header col-xs-12">
  				<h1>Contact Information</h1>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Phone </label>
				<div class="col-sm-9 input-group"> <input type="tel" class="form-control" value="<?= $phoneNumber; ?>" placeholder="<?= $phoneNumber; ?>"></div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Mobile </label>
				<div class="col-sm-9 input-group"> <input type="tel" class="form-control" value="<?= $phoneNumber; ?>" placeholder="<?= $phoneNumber; ?>"></div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Fax </label>
				<div class="col-sm-9 input-group"> <input type="tel" class="form-control" value="<?= $phoneNumber; ?>" placeholder="<?= $phoneNumber; ?>"></div>
			</div>
			<div class="col-xs-12 row">
				<label class="col-sm-3">Email </label>
				<div class="col-sm-9 input-group">
					<input type="tel" class="form-control" value="<?= $email; ?>" placeholder="<?= $email; ?>">
					<div class="input-group-btn"><input type="submit" id="edit-submit" name="op" value="Save" class="form-submit btn pull-right" /></div>
				</div>
			</div>
<!-- 			<div class="col-xs-12 row">
				<label class="col-sm-9"></label>
				<div class="col-sm-3"> <input type="submit" value="Save" class="btn pull-right"></div>
			</div> -->
		</div>

		<!-- <div class="row" id="addressBook">
			<div class="page-header col-xs-12">
  				<h1>Address Book</h1>
			</div>
			<div class="col-xs-12 row">
				<div class="col-xs-12 address primary-address">
					<label class="col-sm-2">autoship address</label>
					<div class="col-sm-8">
						<?= $shipping_address['first_name']; ?> <?= $shipping_address['last_name']; ?><br/>
						<?= $shipping_address['thoroughfare']; ?><!-- 
						 <?php if( !is_null($shipping_address['premise']) ) { echo ", {$shipping_address['premise']}"; } ?><!-- 
						 <?php if ( !is_null($shipping_address['sub_premise']) ) { echo ", {$shipping_address['sub_premise']}"; } ?><br/>
						 <?= $shipping_address['locality']; ?>, <?= $shipping_address['administrative_area']; ?> <?= $shipping_address['postal_code']; ?><br/>
						 <?= $shipping_address['country']; ?><br/>
						 <?= $phoneNumber; ?>

					</div>
					<div class="col-sm-2">
						<a href="#" class="col-xs-6">Edit</a>
						<a href="#" class="col-xs-6">Delete</a>
					</div>
				</div>
				<div class="col-xs-12 address">
					<label class="col-sm-2"></label>
					<div class="col-sm-8">
						<?= $account->field_shipping_address[key($account->field_shipping_address)][0]['value']; ?>
					</div>
					<div class="col-sm-2">
						<a href="#" class="col-xs-6">Edit</a>
						<a href="#" class="col-xs-6">Delete</a>
					</div>
				</div>
				<div class="col-xs-12 address">
					<label class="col-sm-2"></label>
					<div class="col-sm-8">
						<?= $account->field_shipping_address[key($account->field_shipping_address)][0]['value']; ?>
					</div>
					<div class="col-sm-2">
						<a href="#" class="col-xs-6">Edit</a>
						<a href="#" class="col-xs-6">Delete</a>
					</div>
				</div>
				<div class="col-xs-12 address">
					<label class="col-sm-9"></label>
					<div class="col-sm-3"> <input type="submit" value="Add New Address" class="btn pull-right"></div>
				</div>
			</div>
		</div> -->

		<!-- <div class="row" id="paymentInformation">
			<div class="page-header col-xs-12">
  				<h1>Payment Cards</h1>
			</div>
			<div class="col-xs-12 row">
				<div class="col-xs-12 address primary-address">
					<label class="col-sm-2">autoship payment</label>
					<div class="col-sm-8">
						<?= $account->field_shipping_address[key($account->field_shipping_address)][0]['value']; ?>
					</div>
					<div class="col-sm-2">
						<a href="#" class="col-xs-6">Edit</a>
						<a href="#" class="col-xs-6">Delete</a>
					</div>
				</div>
				<div class="col-xs-12 address">
					<label class="col-sm-2"></label>
					<div class="col-sm-8">
						<?= $account->field_shipping_address[key($account->field_shipping_address)][0]['value']; ?>
					</div>
					<div class="col-sm-2">
						<a href="#" class="col-xs-6">Edit</a>
						<a href="#" class="col-xs-6">Delete</a>
					</div>
				</div>
				<div class="col-xs-12 address">
					<label class="col-sm-2"></label>
					<div class="col-sm-8">
						<?= $account->field_shipping_address[key($account->field_shipping_address)][0]['value']; ?>
					</div>
					<div class="col-sm-2">
						<a href="#" class="col-xs-6">Edit</a>
						<a href="#" class="col-xs-6">Delete</a>
					</div>
				</div>
				<div class="col-xs-12 address">
					<label class="col-sm-9"></label>
					<div class="col-sm-3"> <input type="submit" value="Add New Card" class="btn pull-right"></div>
				</div>
			</div>
		</div> -->

		<!-- <div class="row" id="myOrders">
			<div class="page-header col-xs-12">
  				<h1>My Orders</h1>
			</div>
			<div class="col-xs-12 row table-responsive">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th>Order #</th>
							<th>Order Date</th>
							<th>Shipped To</th>
							<th>Order Total</th>
							<th>Reward Points</th>
							<th>Order Status</th>
							<th>Tracking #</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th><a href="#">2133378</a></th>
							<td>05/15/2015</td>
							<td><?= "$firstName $lastName"; ?></td>
							<td>$700</td>
							<td>193</td>
							<td>Shipped</td>
							<td>1234543210-99</td>
						</tr>

						<tr>
							<th><a href="#">2133378</a></th>
							<td>05/15/2015</td>
							<td><?= "$firstName $lastName"; ?></td>
							<td>$700</td>
							<td>193</td>
							<td>Shipped</td>
							<td>1234543210-99</td>
						</tr>

						<tr>
							<th><a href="#">2133378</a></th>
							<td>05/15/2015</td>
							<td><?= "$firstName $lastName"; ?></td>
							<td>$700</td>
							<td>193</td>
							<td>Shipped</td>
							<td>1234543210-99</td>
						</tr>

						<tr>
							<th><a href="#">2133378</a></th>
							<td>05/15/2015</td>
							<td><?= "$firstName $lastName"; ?></td>
							<td>$700</td>
							<td>193</td>
							<td>Shipped</td>
							<td>1234543210-99</td>
						</tr>

						<tr>
							<th><a href="#">2133378</a></th>
							<td>05/15/2015</td>
							<td><?= "$firstName $lastName"; ?></td>
							<td>$700</td>
							<td>193</td>
							<td>Shipped</td>
							<td>1234543210-99</td>
						</tr>

						<tr>
							<th><a href="#">2133378</a></th>
							<td>05/15/2015</td>
							<td><?= "$firstName $lastName"; ?></td>
							<td>$700</td>
							<td>193</td>
							<td>Shipped</td>
							<td>1234543210-99</td>
						</tr>

						<tr>
							<th><a href="#">2133378</a></th>
							<td>05/15/2015</td>
							<td><?= "$firstName $lastName"; ?></td>
							<td>$700</td>
							<td>193</td>
							<td>Shipped</td>
							<td>1234543210-99</td>
						</tr>
					</tbody>
				</table>
			</div>


			<ul class="pagination text-center">
				<span>Page 1 of 3</span>

				<!-- <li>
					<a href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li> 
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li>
					<a href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
			 -->
			
			
		</div>

	</form>
<?php
 // echo '<pre>';
 // var_dump($account);
 // echo '</pre>';

?>

</div>
<?php

	drupal_add_js(drupal_get_path('theme', 'rhythm') . '/rhythm_sub/js/account.js');
?>