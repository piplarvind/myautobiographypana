<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

/* --------------  admin side route -------------------- */

/* admin login, dashboard and forgot password */

$route['default_controller'] = 'home/index';

$route['backend'] = "admin/index";
$route['backend/login'] = "admin/index";
$route['backend/index'] = "admin/index";
$route['backend/home'] = "admin/home";
$route['backend/dashboard'] = "admin/home";
$route['backend/log-out'] = "admin/logout";
//$route['logout']="user_accountA/logout";
$route['backend/forgot-password'] = "admin/forgotPassword";
$route['backend/forgot-password-email'] = "admin/checkForgotPasswordEmail";
/* admin login, dashboard and forgot password end here */

/* Global Settings:   */
$route['backend/global-settings/list'] = "global_setting/listGlobalSettings";
$route['backend/global-settings/edit/(:any)'] = "global_setting/editGlobalSettings/$1/$2";
$route['backend/global-settings/edit-parameter-language/(:any)'] = "global_setting/editParameterLanguage/$1";
$route['backend/global-settings/get-global-parameter-language'] = "global_setting/getGlobalParameterLanguage";
/* Global Settings End Here */

/* Manage Role: */
$route['backend/role/list'] = "role/listRole";
$route['backend/role/edit/(:any)'] = "role/addRole/$1";
$route['backend/role/add'] = "role/addRole";
$route['backend/role/check-role'] = "role/checkRole";
$route['backend/chk-role-name'] = "role/checkDuplicateUserRole";
/* Manage Role End Here */

/* Manage Admin  */
$route['backend/admin/list'] = "admin/listAdmin";
$route['backend/admin/change-status'] = "admin/changeStatus";
$route['backend/admin/add'] = "admin/addAdmin";
$route['backend/admin/check-admin-username'] = "admin/checkAdminUsername";
$route['backend/admin/check-admin-email'] = "admin/checkAdminEmail";
$route['backend/admin/account-activate/(:any)'] = "admin/activateAccount/$1";
$route['backend/admin/edit/(:any)'] = "admin/editAdmin/$1";
$route['backend/admin/profile'] = "admin/adminProfile";
$route['backend/admin/edit-profile'] = "admin/editProfile";
$route['backend/admin/manage-notification'] = "admin/manageNotification";
$route['backend/admin/delete-notification/(:any)'] = "admin/deleteNotification/$1";
/* Manage Admin End Here */

/*
 * Manage User A Start Here
 */
$route['backend/user-a/list/(:any)'] = "user/listUserA/$1/$2";
$route['backend/user-a/list/(:any)'] = "user/listUserA/$1";
$route['backend/user-a/list'] = "user/listUserA";
$route['backend/user-a/change-status'] = "user/changeStatusA";
$route['backend/user-a/add'] = "user/addUserA";
$route['backend/user-a/check-user-username'] = "user/checkUserUsernameA";
$route['backend/user-a/check-user-email'] = "user/checkUserEmailA";
$route['backend/user-a/account-activate/(:any)'] = "user/activateAccountA/$1";
$route['backend/user-a/edit/(:any)'] = "user/editUserA/$1";
$route['backend/user-a/view/(:any)'] = "user/userProfileA/$1";
$route['backend/user-a/delete-user/(:any)'] = "user/deleteUserA/$1";
/*
 * Manage User A End Here
 */

/*
 * Manage User B Start Here
 */

$route['backend/user-b/list'] = "user/listUserB";
$route['backend/user-b/list/(:any)'] = "user/listUserB/$1";
$route['backend/user-b/list/(:any)'] = "user/listUserB/$1/$2";
$route['backend/user-b/change-status'] = "user/changeStatusB";
$route['backend/user-b/add'] = "user/addUserB";
$route['backend/user-b/check-user-username'] = "user/checkUserUsernameB";
$route['backend/user-b/check-user-email'] = "user/checkUserEmailB";
$route['backend/user-b/account-activate/(:any)'] = "user/activateAccountB/$1";
$route['backend/user-b/edit/(:any)'] = "user/editUserB/$1";
$route['backend/user-b/view/(:any)'] = "user/userProfileB/$1";
$route['backend/user-b/delete-user/(:any)'] = "user/deleteUserB/$1";
/*
 * Manage User BS End Here
 */

/* Start:: Manage Interest routes */
$route['backend/manage-interest'] = "interest/listInterest";
$route['backend/add-interest'] = "interest/addInterest";
$route['backend/edit-interest/(:any)'] = "interest/editInterest/$1";
$route['backend/interest/change-status'] = "interest/changeStatus";
$route['backend/interest/check-interest-name'] = "interest/checkInterestName";
/* :: Manage Interest Ends Here */


/*
 * Manage Newsletter start
 */
$route['backend/newsletter/list'] = "newsletter/listNewsletter";
$route['backend/newsletter/add'] = "newsletter/addNewsletter";
$route['backend/newsletter/upload-cleditor-image'] = "newsletter/uploadClEditorImage";
$route['backend/newsletter/change-status'] = "newsletter/changeStatus";
$route['backend/newsletter/edit/(:any)'] = "newsletter/editNewsletter/$1";
$route['backend/newsletter/send-newsletter/(:any)'] = "newsletter/sendNewsletter/$1";
$route['backend/get-all-users'] = "newsletter/gettingAllUsersByStatus";

/*
 * Manage Newsletter end
 */

/* Start:: Manage Geoname routes */
$route['backend/manage-states'] = "geoname/listStates";
$route['backend/add-states'] = "geoname/addStates";
$route['backend/states/change-status'] = "geoname/changeStateStatus";
$route['backend/edit-states/(:any)'] = "geoname/editStates/$1";
$route['backend/manage-cities'] = "geoname/listCities";
$route['backend/add-cities'] = "geoname/addCities";
$route['backend/cities/select-states'] = "geoname/selectStates";
$route['backend/cities/change-status'] = "geoname/changeCityStatus";
$route['backend/edit-cities/(:any)'] = "geoname/editCities/$1";
$route['backend/geoname/check-state-name'] = "geoname/checkStateName";
$route['backend/geoname/check-city-name'] = "geoname/checkCityName";
/* :: Manage Geoname Ends Here */


/* Start:: Manage Institute Type routes */
$route['backend/manage-institute-type'] = "institute_type/listInstituteType";
$route['backend/add-institute-type'] = "institute_type/addInstituteType";
$route['backend/edit-institute-type/(:any)'] = "institute_type/editInstituteType/$1";
$route['backend/institute-type/change-status'] = "institute_type/changeStatus";
$route['backend/institute-type/check-institute-type'] = "institute_type/checkInstituteType";
/* :: Manage Institute Type  Ends Here */

/*
 * Manage User End Here
 */
/* Manage Category Details */


/* Category Module :   */
$route['backend/category/list/(:any)'] = "category/listCategory/$1";
$route['backend/categories/add-category'] = "category/addCategory";
$route['backend/categories/add-category/(:any)'] = "category/addCategory/$1";
$route['backend/categories/list-interest/(:any)'] = "category/listInterest/$1";
$route['backend/categories/add-interest/(:any)'] = "category/addInterest/$1/$2";
$route['backend/categories/add-interest/(:any)'] = "category/addInterest/$1";
$route['backend/categories/edit-interest/(:any)'] = "category/editInterest/$1";
$route['backend/categories/post-for-timeline/(:any)'] = "category/postForTimeline/$1/$2";
$route['backend/categories/edit-post-timeline/(:any)'] = "category/editPostTimeline/$1/$2";
$route['backend/categories/delete-timeline-image/(:any)'] = "category/deleteTimelineImage/$1/$2";
$route['backend/categories/view-timeline/(:any)'] = "category/viewTimeline/$1/$2";
$route['backend/categories/view-comments/(:any)'] = "category/viewComments/$1";
$route['backend/categories/comments-status'] = "category/commentStatus";
$route['backend/categories/timeline-status'] = "category/timelineStatus";
$route['backend/categories/add-timeline-comment/(:any)'] = "category/addComment/$1";
$route['backend/categories/edit-timeline-comment/(:any)'] = "category/editComment/$1";
$route['backend/categories/edit-category'] = "category/editCategory";
$route['backend/categories/edit-category/(:any)'] = "category/editCategory/$1";
$route['backend/categories/edit-category-language/(:any)'] = "category/editCategoryLanguage/$1";
$route['backend/categories/edit-category-language/(:any)/(:any)'] = "category/editCategoryLanguage/$1/$2";
$route['backend/categories/edit-category-language'] = "category/editCategoryLanguage";
$route['backend/categories/get-category-language'] = "category/getCategoryLanguage";
$route['backend/categories/get-language-for-categories'] = 'category/getlanguageforcategories';
$route['backend/categories/validate-category-name'] = 'category/validateCategory';
$route['backend/categories/validate-page-url'] = 'category/validatePageUrl';
$route['backend/categories/delete-category'] = 'category/deleteCategory';
$route['backend/category/check-cat-name'] = "category/checkCategoryNameExist";
/* Manage Category Details end here */



/** Gallery backend route start here * */
$route['backend/manage-gallery'] = "gallery/manageGallery";
$route['backend/edit-gallery/(:any)'] = "gallery/editGallery/$1";
$route['backend/delete-gallery-image/(:any)'] = "gallery/deleteGalleryImage/$1";
$route['backend/gallery/change-status'] = "gallery/changeGalleryStatus";
/** Gallery frontend route start here * */
/** Manage Other Interest backend route start here * */
$route['backend/manage-other-interest'] = "category/manageOtherInterest";
/** Manage Other Interest backend route end here * */
/** Advertise backend route start here * */
$route['backend/advertises'] = "advertise/listAdvertises";
$route['backend/preview-advertise/(:any)'] = "advertise/previewAdvertise/$1";
$route['backend/change-advertise-status/(:any)'] = "advertise/changeAdvertiseStatus/$1/$2";
$route['backend/edit-advertise/(:any)'] = "advertise/editAdvertise/$1";
$route['backend/add-advertise'] = "advertise/addAdvertise";
$route['backend/advertise-categories'] = "advertise/listAdsCategories";
$route['backend/add-advertise-category'] = "advertise/addAdvertiseCategory";
$route['backend/add-advertise-category/(:any)'] = "advertise/addAdvertiseCategory/$1";
$route['backend/change-advertise-category-status/(:any)'] = "advertise/addAdvertiseCategoryStatus/$1/$2";
$route['backend/advertise-check-duplicate-category-name'] = "advertise/advertiseCheckDuplicateCategoryName";
/** Addvertise backend route end here * */
/** Post add front route start here * */
$route['post-add'] = "advertise/postAdd";
/** Post add front route end here * */
/*
 * Manage email template routes
 */
$route['backend/email-template/list'] = "email_template/index";
$route['backend/edit-email-template/(:any)'] = "email_template/editEmailTemplate/$1";
$route['backend/assign-email-template-macro/(:any)'] = "email_template/assignEmailTemplateMacro/$1";
$route['backend/email-template-macros'] = "email_template/emailTemplateMacros";
$route['backend/add-email-template-macro/(:any)'] = "email_template/addTemplateMacros/$1";
$route['backend/add-email-template-macro'] = "email_template/addTemplateMacros";
/*
 * Manage email template routes end
 */

//contact us
$route['backend/contact-us'] = "contact_us/listContactUs";
$route['backend/contact-us/view/(:any)'] = "contact_us/view/$1";
$route['backend/contact-us/reply/(:any)'] = "contact_us/reply/$1";


//cms
$route['backend/cms'] = "cms/listCMS";
$route['backend/cms/edit-cms/(:any)'] = "cms/editCMS/$1";
$route['backend/cms/edit-cms-language/(:any)'] = "cms/editCmsLanguage/$1";
$route['backend/cms/get-cms-language'] = "cms/getCmsLanguage";
$route['media/backend/editor-image'] = "cms/editorImageUpload";

#Manage Language start here
$route['backend/check-keyword-exists'] = "language/checkKeywordExists";
$route['backend/add-keyword'] = "language/addKeyword";
$route['backend/language-keyword/list'] = "language/index";
$route['backend/get-language-page-keywords'] = "language/getKeywords";

$route['switch-language/(:any)'] = "language/switchLanguage/$1";
$route['switch-language'] = "language/switchLanguage";


#[Start]: Bulk Upload Users

$route['backend/new-user/send-activation/(:any)'] = "user/NewUserSendActivation/$1";
//$route['backend/new-user/send-activation/(:any)'] = "user/NewUserSendActivation/$1/$2";
$route['backend/new-user/list/(:any)'] = "user/listNewUploadedUser/$1/$2";
$route['backend/new-user/list/(:any)'] = "user/listNewUploadedUser/$1";
$route['backend/new-user/list'] = "user/listNewUploadedUser";

$route['bulk-upload-User'] = 'user/bulkUploadUser';
$route['bulk-upload-User-action'] = 'user/bulkUploadUserAction';

#[End]: Bulk Upload Users
#Manage Language end here
/* --------------  admin side route end here -------------------- */


$route['home'] = "home";
$route['digital-record'] = "home/digital_record";
$route['digital-record-details/(:any)'] = "home/digital_record_details/$1";
$route['tiles'] = "home/tiles";

$route['reset'] = "register/reset";


/* ------------Start ::: UI1 Tiles ---------------------------------------- */
$route['personal-brownies'] = "tiles/personal_brownies";
$route['institute-brownies'] = "tiles/institute_brownies";
$route['me-tile'] = "tiles/me_tile";
$route['timeline'] = "tiles/timeline";
$route['ad1'] = "tiles/ad1";
$route['ad2'] = "tiles/ad2";
$route['ad3'] = "tiles/ad3";
$route['second-ad3'] = "tiles/second_ad3";
$route['second-ad2'] = "tiles/second_ad2";
$route['second-ad1'] = "tiles/second_ad1";
$route['tile/dr'] = "tiles/digital_record";
$route['site-info1'] = "tiles/site_info1";
$route['site-info2'] = "tiles/site_info2";
$route['site-info3'] = "tiles/site_info3";
$route['friend-tile1'] = "tiles/friend_tile1";
$route['friend-tile2'] = "tiles/friend_tile2";
$route['friend-tile3'] = "tiles/friend_tile3";
$route['newsrender'] = "tiles/newsrender";
$route['calender'] = "tiles/calender";
$route['social'] = "tiles/social";

$route['my-gaming1'] = "tiles/my_gaming1";
$route['my-gaming2'] = "tiles/my_gaming2";
$route['my-gaming3'] = "tiles/my_gaming3";

$route['my-music1'] = "tiles/my_music1";
$route['my-music2'] = "tiles/my_music2";
$route['my-music3'] = "tiles/my_music3";

$route['my-video1'] = "tiles/my_video1";
$route['my-video2'] = "tiles/my_video2";
$route['my-video3'] = "tiles/my_video3";


/* ------------End   ::: UI1 Tiles ---------------------------------------- */



$route['get-user-notification'] = "home/getUserNotification";
$route['show-user-notification'] = "home/showUserNotification";
$route['forgot-password'] = "register/forgot_password";
//$route['forgot-email'] = "register/forgot_email";
$route['forgot-password-action'] = "register/forgot_password_action";
//$route['security-forgot-password-action'] = "register/security_forgot_password_action";
$route['password-reset/(:any)'] = "register/password_reset/$1";
//$route['password-reset-action'] = "register/password_reset_action";
$route['chk-edit-email-duplicate'] = "register/chkEditEmailDuplicate";
$route['forgot-password-email-exist'] = "register/check_user_email_forgot_password";

$route['signup-institute'] = "register/userRegistrationB";
$route['signup-student'] = "register/userRegistrationStep1";
$route['registration/step2'] = "register/userRegistrationStep2";
$route['fb-signup'] = "register/fbUserRegistration";
$route['chk-email-duplicate'] = "register/chkEmailDuplicate";
$route['chk-album-duplicate'] = "register/chkAlbumDuplicate";
$route['chk-email-exist'] = "register/chkEmailExist";
$route['user-activation/(:any)'] = "register/userActivation/$1";
$route['signin'] = "register/signin";
$route['userA-signin'] = "register/signin";
$route['password-recovery'] = "register/passwordRecovery";
$route['reset-password/(:any)'] = "register/resetPassword/$1";
$route['reset-password'] = "register/resetPassword";
$route['logout'] = "register/logout";
$route['fb-user-institute-type'] = "register/fbUserRegistrationAction";


/* * ******************user A (student)******************************** */
//$route['student/user-profile'] = "user_accountA/userProfile";
$route['usera-private-timeline'] = "user_accountA/userProfile";
$route['student-user-profile'] = "user_accountA/userAProfile";
//$route['student/user-friends'] = "user_accountA/userAFriends";
$route['student/user-manage-friends'] = "user_accountA/userAManageFriends";
$route['student/user-private-messages'] = "user_accountA/userAMessages";
$route['student/user-account-setting'] = "user_accountA/userAAcoountSetting";
$route['student/user-about'] = "user_accountA/aboutUserA";
$route['student-my-profile'] = "user_accountA/userAMyProfile";
$route['student-time-line/(:any)'] = "user_accountA/studentTimeLine/$1/$2";
$route['comment-on-timeline'] = "user_accountA/postCommentOnTimeline";
/* * ******************user A ******************************** */
//$route['user-profile'] = "user_accountA/userProfile";
//$route['userA-profile'] = "user_accountA/userAProfile";
//$route['student-my-profile'] = "user_accountA/userAMyProfile";
//$route['userA-friends'] = "user_accountA/userAFriends";
//$route['userA-manage-friends'] = "user_accountA/userAManageFriends";
//$route['userA-private-messages'] = "user_accountA/userAMessages";
//$route['userA-account-setting'] = "user_accountA/userAAcoountSetting";
//$route['userA-about'] = "user_accountA/aboutUserA";

$route['edit-userA-profile'] = "user_accountA/editUserAProfile";
$route['profileA'] = "user_accountA/profileA";
$route['user-activation-front/(:any)'] = "user_accountA/userActivation/$1";
$route['new-user-activation/(:any)'] = "user_accountA/newUserActivation/$1";


/* * *******************time line setting************************* */
$route['timeline-setting'] = "user_accountA/timeLineSetting";
$route['institute/timeline-setting'] = "user_accountB/timeLineSetting";
$route['my-news'] = "user_accountA/myNews";
//$route['institute/my-news'] = "user_accountB/myNews";
$route['institute/add-User-list'] = "user_accountB/addUserList";


/* * ***********user A album*************** */
$route['my/album'] = "user_photos/userAlbumsAction";
$route['my/photos/(:any)'] = "user_photos/userPhotos/$1";
$route['show-album-images/(:any)'] = "user_photos/showAlbumImages/$1";
$route['public-profile-album-images/(:any)'] = "user_photos/publicProfileAlbumImages/$1";

$route['ajax-upload-photos'] = "user_photos/ajax_photo_upload";
$route['delete-photo'] = "user_photos/deleteAlbumPhoto";
$route['delete-album'] = "user_photos/deleteAlbum";
$route['fb-connect'] = "user_photos/getFBPhotos";
$route['print-photos'] = "user_photos/printPhotos";
$route['import-album'] = "user_photos/importFacebookAlbums";
$route['album-photos/(:any)'] = "user_photos/importFacebookPhotosByAlbum/$1";
$route['get-avail-paper-sizes'] = "user_photos/getAvailablePaperSizes";

/* * **************user B(Institution)******************** */
//$route['institute/user-profile'] = "user_accountB/userProfile";
$route['institute-private-timeline'] = "user_accountB/userProfile";
$route['institute-user-profile'] = "user_accountB/userBProfile";
$route['institute/user-account-setting'] = "user_accountB/userBAcoountSetting";
$route['institute/user-manage-friends'] = "user_accountB/userBManageFriends";
$route['institute/user-private-messages'] = "user_accountB/userBMessages";
$route['institute/edit-user-profile'] = "user_accountB/editUserBProfile";
$route['profileB'] = "user_accountB/profileB";
$route['userB-activation-front/(:any)'] = "user_accountB/userActivation/$1";
$route['institution-my-profile'] = "user_accountB/userBMyProfile";
$route['institute-time-line/(:any)'] = "user_accountB/instituteTimeLine/$1/$2";
$route['ajax-images-upload'] = "user_accountB/ajaxImageUpload";
$route['get-more-timeline'] = "user_accountB/getMoreTimeLine";
$route['institue/user-manage-friends'] = "user_accountB/userBManageFriends";
$route['follow-buisness-user'] = "user_accountB/followFriendsUser";
//$route['unfollow-buisness-user'] = "user_accountB/unFollowFriendsUser";
$route['change-institute-cover-pic'] = "user_accountB/changeInstituteCoverPhoto";
$route['comment-on-institute-time-line'] = "user_accountB/postCommentOnInstituteTimeline";



/* * ********user B Gallery ****** */
//$route['gallery'] = "user_accountB/timelineGallery";
$route['gallery/(:any)'] = "user_accountB/timelineGallery/$1";
$route['delete-notification/(:any)'] = "home/deleteNotification/$1";

/* * *********************institutional_brownies******************** */
//$route['institutional-brownies'] = "user_accountB/institutionalBrownies";
//$route['institutional-brownies/(:any)'] = "user_accountB/institutionalBrownies/$1";
//
//$route['edit-institutional-brownies'] = "user_accountB/editIinstitutionalBbrownies";
//$route['edit-institutional-brownies/(:any)'] = "user_accountB/editIinstitutionalBbrownies/$1";
#CMS :
$route['cms/(:any)'] = "cms/cmsPage/$1";
#Front-end Contact-us :
$route['contact-us'] = "cms/contactUs";
$route['contact-us-action'] = "contact_us";
$route['check-empty-cms'] = "cms/check_empty_cms";
$route['media/backend/editor-image-upload'] = "cms/editorImageUpload";
$route['upload-image'] = "cms/uploadImage";

$route['allfriends/(:any)'] = "user_accountB/ViewAllFriends/$1";

$route['profile/album/(:any)/(:any)'] = "user_photos/publicProfileAlbumImages/$1/$2";
$route['profile/(:any)'] = "user_accountB/publicProfile/$1";
$route['institute/banner'] = "banner/uploadBanner";
$route['institute/banner-management'] = "banner/bannerManagement";
$route['institute/banner/change-status'] = "banner/changeStatus";
$route['institute/edit-banner/(:any)'] = "banner/editBanner/$1";
$route['institute/delete-banner/(:any)'] = "banner/deleteBanner/$1";

//$route['(:any)'] = "user_accountB/publicProfile/$1";


$route['404_override'] = '';
$route['page-not-found'] = 'cms/pageNotFound';






/* End of file routes.php */
/* Location: ./application/config/routes.php */
