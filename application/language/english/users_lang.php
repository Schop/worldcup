<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*
* Filename:		users_lang.php
* Language:		english
* Author:		John Schop
* 		  		john.schop@gmail.com
* Created:		2017.03.30
*
* Description:  English language file for admin/user controller
*
*/

$lang['users_no_access'] = 'You are not allowed to visit the users page';
$lang['users_in_group'] = 'Users in group \'%s\'';
$lang['all_users'] = 'All users';
$lang['create_new_user'] = 'Create New User';
$lang['show_all_users'] = 'Show all users';
$lang['show_users_in_group'] = 'Show users in group \'%s\'';
$lang['ID'] = 'ID';
$lang['first_name'] = 'First Name';
$lang['last_name'] = 'Last Name';
$lang['username'] = 'Username';
$lang['name'] = 'Name';
$lang['email'] = 'Email';
$lang['password'] = 'Password';
$lang['password_confirm'] = 'Password Confirm';
$lang['password_confirmation'] = 'Password Confirm';
$lang['groups'] = 'Groups';
$lang['last_login'] = 'Last Login';
$lang['operations'] = 'Operations';
$lang['edit_user'] = 'Edit User';
$lang['delete_user'] = 'Delete User';
$lang['create_user'] = 'Create User';
$lang['cancel'] = 'Cancel';
$lang['save'] = 'Save';

$lang['edit_user'] = 'Edit User';

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Please login with your email/username and password below.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Remember Me:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Forgot your password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading']                           = 'Create User';
$lang['create_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['create_user_fname_label']                       = 'First Name:';
$lang['create_user_lname_label']                       = 'Last Name:';
$lang['create_user_company_label']                     = 'Company Name:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Phone:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Confirm Password:';
$lang['create_user_submit_btn']                        = 'Create User';
$lang['create_user_validation_fname_label']            = 'First Name';
$lang['create_user_validation_lname_label']            = 'Last Name';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Email Address';
$lang['create_user_validation_phone_label']            = 'Phone';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';

// Edit User
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone_label']            = 'Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_identity_label'] = 'Identity';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';
