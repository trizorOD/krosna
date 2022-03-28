<?php
/* Loads Themify Icons Font. */

// Enqueue CSS
wp_enqueue_style( 'font-ion-icons', LEARTS_ADDONS_URL . '/assets/libs/Ionicons/css/ionicons.min.css' );

add_filter( 'vc_iconpicker-type-ionicons', 'vc_iconpicker_type_ionicons' );

/**
 * Iconicons
 *
 * @param $icons - taken from filter - vc_map param field settings['source'] provided icons (default empty array).
 *               If array categorized it will auto-enable category dropdown
 *
 * @since 4.4
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
function vc_iconpicker_type_ionicons( $icons ) {
	$ion_icons = array(
		array( 'ion-ionic' => 'ionic' ),
		array( 'ion-arrow-up-a' => 'arrow-up-a' ),
		array( 'ion-arrow-right-a' => 'arrow-right-a' ),
		array( 'ion-arrow-down-a' => 'arrow-down-a' ),
		array( 'ion-arrow-left-a' => 'arrow-left-a' ),
		array( 'ion-arrow-up-b' => 'arrow-up-b' ),
		array( 'ion-arrow-right-b' => 'arrow-right-b' ),
		array( 'ion-arrow-down-b' => 'arrow-down-b' ),
		array( 'ion-arrow-left-b' => 'arrow-left-b' ),
		array( 'ion-arrow-up-c' => 'arrow-up-c' ),
		array( 'ion-arrow-right-c' => 'arrow-right-c' ),
		array( 'ion-arrow-down-c' => 'arrow-down-c' ),
		array( 'ion-arrow-left-c' => 'arrow-left-c' ),
		array( 'ion-arrow-return-right' => 'arrow-return-right' ),
		array( 'ion-arrow-return-left' => 'arrow-return-left' ),
		array( 'ion-arrow-swap' => 'arrow-swap' ),
		array( 'ion-arrow-shrink' => 'arrow-shrink' ),
		array( 'ion-arrow-expand' => 'arrow-expand' ),
		array( 'ion-arrow-move' => 'arrow-move' ),
		array( 'ion-arrow-resize' => 'arrow-resize' ),
		array( 'ion-chevron-up' => 'chevron-up' ),
		array( 'ion-chevron-right' => 'chevron-right' ),
		array( 'ion-chevron-down' => 'chevron-down' ),
		array( 'ion-chevron-left' => 'chevron-left' ),
		array( 'ion-navicon-round' => 'navicon-round' ),
		array( 'ion-navicon' => 'navicon' ),
		array( 'ion-drag' => 'drag' ),
		array( 'ion-log-in' => 'log-in' ),
		array( 'ion-log-out' => 'log-out' ),
		array( 'ion-checkmark-round' => 'checkmark-round' ),
		array( 'ion-checkmark' => 'checkmark' ),
		array( 'ion-checkmark-circled' => 'checkmark-circled' ),
		array( 'ion-close-round' => 'close-round' ),
		array( 'ion-close' => 'close' ),
		array( 'ion-close-circled' => 'close-circled' ),
		array( 'ion-plus-round' => 'plus-round' ),
		array( 'ion-plus' => 'plus' ),
		array( 'ion-plus-circled' => 'plus-circled' ),
		array( 'ion-minus-round' => 'minus-round' ),
		array( 'ion-minus' => 'minus' ),
		array( 'ion-minus-circled' => 'minus-circled' ),
		array( 'ion-information' => 'information' ),
		array( 'ion-information-circled' => 'information-circled' ),
		array( 'ion-help' => 'help' ),
		array( 'ion-help-circled' => 'help-circled' ),
		array( 'ion-backspace-outline' => 'backspace-outline' ),
		array( 'ion-backspace' => 'backspace' ),
		array( 'ion-help-buoy' => 'help-buoy' ),
		array( 'ion-asterisk' => 'asterisk' ),
		array( 'ion-alert' => 'alert' ),
		array( 'ion-alert-circled' => 'alert-circled' ),
		array( 'ion-refresh' => 'refresh' ),
		array( 'ion-loop' => 'loop' ),
		array( 'ion-shuffle' => 'shuffle' ),
		array( 'ion-home' => 'home' ),
		array( 'ion-search' => 'search' ),
		array( 'ion-flag' => 'flag' ),
		array( 'ion-star' => 'star' ),
		array( 'ion-heart' => 'heart' ),
		array( 'ion-heart-broken' => 'heart-broken' ),
		array( 'ion-gear-a' => 'gear-a' ),
		array( 'ion-gear-b' => 'gear-b' ),
		array( 'ion-toggle-filled' => 'toggle-filled' ),
		array( 'ion-toggle' => 'toggle' ),
		array( 'ion-settings' => 'settings' ),
		array( 'ion-wrench' => 'wrench' ),
		array( 'ion-hammer' => 'hammer' ),
		array( 'ion-edit' => 'edit' ),
		array( 'ion-trash-a' => 'trash-a' ),
		array( 'ion-trash-b' => 'trash-b' ),
		array( 'ion-document' => 'document' ),
		array( 'ion-document-text' => 'document-text' ),
		array( 'ion-clipboard' => 'clipboard' ),
		array( 'ion-scissors' => 'scissors' ),
		array( 'ion-funnel' => 'funnel' ),
		array( 'ion-bookmark' => 'bookmark' ),
		array( 'ion-email' => 'email' ),
		array( 'ion-email-unread' => 'email-unread' ),
		array( 'ion-folder' => 'folder' ),
		array( 'ion-filing' => 'filing' ),
		array( 'ion-archive' => 'archive' ),
		array( 'ion-reply' => 'reply' ),
		array( 'ion-reply-all' => 'reply-all' ),
		array( 'ion-forward' => 'forward' ),
		array( 'ion-share' => 'share' ),
		array( 'ion-paper-airplane' => 'paper-airplane' ),
		array( 'ion-link' => 'link' ),
		array( 'ion-paperclip' => 'paperclip' ),
		array( 'ion-compose' => 'compose' ),
		array( 'ion-briefcase' => 'briefcase' ),
		array( 'ion-medkit' => 'medkit' ),
		array( 'ion-at' => 'at' ),
		array( 'ion-pound' => 'pound' ),
		array( 'ion-quote' => 'quote' ),
		array( 'ion-cloud' => 'cloud' ),
		array( 'ion-upload' => 'upload' ),
		array( 'ion-more' => 'more' ),
		array( 'ion-grid' => 'grid' ),
		array( 'ion-calendar' => 'calendar' ),
		array( 'ion-clock' => 'clock' ),
		array( 'ion-compass' => 'compass' ),
		array( 'ion-pinpoint' => 'pinpoint' ),
		array( 'ion-pin' => 'pin' ),
		array( 'ion-navigate' => 'navigate' ),
		array( 'ion-location' => 'location' ),
		array( 'ion-map' => 'map' ),
		array( 'ion-lock-combination' => 'lock-combination' ),
		array( 'ion-locked' => 'locked' ),
		array( 'ion-unlocked' => 'unlocked' ),
		array( 'ion-key' => 'key' ),
		array( 'ion-arrow-graph-up-right' => 'arrow-graph-up-right' ),
		array( 'ion-arrow-graph-down-right' => 'arrow-graph-down-right' ),
		array( 'ion-arrow-graph-up-left' => 'arrow-graph-up-left' ),
		array( 'ion-arrow-graph-down-left' => 'arrow-graph-down-left' ),
		array( 'ion-stats-bars' => 'stats-bars' ),
		array( 'ion-connection-bars' => 'connection-bars' ),
		array( 'ion-pie-graph' => 'pie-graph' ),
		array( 'ion-chatbubble' => 'chatbubble' ),
		array( 'ion-chatbubble-working' => 'chatbubble-working' ),
		array( 'ion-chatbubbles' => 'chatbubbles' ),
		array( 'ion-chatbox' => 'chatbox' ),
		array( 'ion-chatbox-working' => 'chatbox-working' ),
		array( 'ion-chatboxes' => 'chatboxes' ),
		array( 'ion-person' => 'person' ),
		array( 'ion-person-add' => 'person-add' ),
		array( 'ion-person-stalker' => 'person-stalker' ),
		array( 'ion-woman' => 'woman' ),
		array( 'ion-man' => 'man' ),
		array( 'ion-female' => 'female' ),
		array( 'ion-male' => 'male' ),
		array( 'ion-transgender' => 'transgender' ),
		array( 'ion-fork' => 'fork' ),
		array( 'ion-knife' => 'knife' ),
		array( 'ion-spoon' => 'spoon' ),
		array( 'ion-soup-can-outline' => 'soup-can-outline' ),
		array( 'ion-soup-can' => 'soup-can' ),
		array( 'ion-beer' => 'beer' ),
		array( 'ion-wineglass' => 'wineglass' ),
		array( 'ion-coffee' => 'coffee' ),
		array( 'ion-icecream' => 'icecream' ),
		array( 'ion-pizza' => 'pizza' ),
		array( 'ion-power' => 'power' ),
		array( 'ion-mouse' => 'mouse' ),
		array( 'ion-battery-full' => 'battery-full' ),
		array( 'ion-battery-half' => 'battery-half' ),
		array( 'ion-battery-low' => 'battery-low' ),
		array( 'ion-battery-empty' => 'battery-empty' ),
		array( 'ion-battery-charging' => 'battery-charging' ),
		array( 'ion-wifi' => 'wifi' ),
		array( 'ion-bluetooth' => 'bluetooth' ),
		array( 'ion-calculator' => 'calculator' ),
		array( 'ion-camera' => 'camera' ),
		array( 'ion-eye' => 'eye' ),
		array( 'ion-eye-disabled' => 'eye-disabled' ),
		array( 'ion-flash' => 'flash' ),
		array( 'ion-flash-off' => 'flash-off' ),
		array( 'ion-qr-scanner' => 'qr-scanner' ),
		array( 'ion-image' => 'image' ),
		array( 'ion-images' => 'images' ),
		array( 'ion-wand' => 'wand' ),
		array( 'ion-contrast' => 'contrast' ),
		array( 'ion-aperture' => 'aperture' ),
		array( 'ion-crop' => 'crop' ),
		array( 'ion-easel' => 'easel' ),
		array( 'ion-paintbrush' => 'paintbrush' ),
		array( 'ion-paintbucket' => 'paintbucket' ),
		array( 'ion-monitor' => 'monitor' ),
		array( 'ion-laptop' => 'laptop' ),
		array( 'ion-ipad' => 'ipad' ),
		array( 'ion-iphone' => 'iphone' ),
		array( 'ion-ipod' => 'ipod' ),
		array( 'ion-printer' => 'printer' ),
		array( 'ion-usb' => 'usb' ),
		array( 'ion-outlet' => 'outlet' ),
		array( 'ion-bug' => 'bug' ),
		array( 'ion-code' => 'code' ),
		array( 'ion-code-working' => 'code-working' ),
		array( 'ion-code-download' => 'code-download' ),
		array( 'ion-fork-repo' => 'fork-repo' ),
		array( 'ion-network' => 'network' ),
		array( 'ion-pull-request' => 'pull-request' ),
		array( 'ion-merge' => 'merge' ),
		array( 'ion-xbox' => 'xbox' ),
		array( 'ion-playstation' => 'playstation' ),
		array( 'ion-steam' => 'steam' ),
		array( 'ion-closed-captioning' => 'closed-captioning' ),
		array( 'ion-videocamera' => 'videocamera' ),
		array( 'ion-film-marker' => 'film-marker' ),
		array( 'ion-disc' => 'disc' ),
		array( 'ion-headphone' => 'headphone' ),
		array( 'ion-music-note' => 'music-note' ),
		array( 'ion-radio-waves' => 'radio-waves' ),
		array( 'ion-speakerphone' => 'speakerphone' ),
		array( 'ion-mic-a' => 'mic-a' ),
		array( 'ion-mic-b' => 'mic-b' ),
		array( 'ion-mic-c' => 'mic-c' ),
		array( 'ion-volume-high' => 'volume-high' ),
		array( 'ion-volume-medium' => 'volume-medium' ),
		array( 'ion-volume-low' => 'volume-low' ),
		array( 'ion-volume-mute' => 'volume-mute' ),
		array( 'ion-levels' => 'levels' ),
		array( 'ion-play' => 'play' ),
		array( 'ion-pause' => 'pause' ),
		array( 'ion-stop' => 'stop' ),
		array( 'ion-record' => 'record' ),
		array( 'ion-skip-forward' => 'skip-forward' ),
		array( 'ion-skip-backward' => 'skip-backward' ),
		array( 'ion-eject' => 'eject' ),
		array( 'ion-bag' => 'bag' ),
		array( 'ion-card' => 'card' ),
		array( 'ion-cash' => 'cash' ),
		array( 'ion-pricetag' => 'pricetag' ),
		array( 'ion-pricetags' => 'pricetags' ),
		array( 'ion-thumbsup' => 'thumbsup' ),
		array( 'ion-thumbsdown' => 'thumbsdown' ),
		array( 'ion-happy-outline' => 'happy-outline' ),
		array( 'ion-happy' => 'happy' ),
		array( 'ion-sad-outline' => 'sad-outline' ),
		array( 'ion-sad' => 'sad' ),
		array( 'ion-bowtie' => 'bowtie' ),
		array( 'ion-tshirt-outline' => 'tshirt-outline' ),
		array( 'ion-tshirt' => 'tshirt' ),
		array( 'ion-trophy' => 'trophy' ),
		array( 'ion-podium' => 'podium' ),
		array( 'ion-ribbon-a' => 'ribbon-a' ),
		array( 'ion-ribbon-b' => 'ribbon-b' ),
		array( 'ion-university' => 'university' ),
		array( 'ion-magnet' => 'magnet' ),
		array( 'ion-beaker' => 'beaker' ),
		array( 'ion-erlenmeyer-flask' => 'erlenmeyer-flask' ),
		array( 'ion-egg' => 'egg' ),
		array( 'ion-earth' => 'earth' ),
		array( 'ion-planet' => 'planet' ),
		array( 'ion-lightbulb' => 'lightbulb' ),
		array( 'ion-cube' => 'cube' ),
		array( 'ion-leaf' => 'leaf' ),
		array( 'ion-waterdrop' => 'waterdrop' ),
		array( 'ion-flame' => 'flame' ),
		array( 'ion-fireball' => 'fireball' ),
		array( 'ion-bonfire' => 'bonfire' ),
		array( 'ion-umbrella' => 'umbrella' ),
		array( 'ion-nuclear' => 'nuclear' ),
		array( 'ion-no-smoking' => 'no-smoking' ),
		array( 'ion-thermometer' => 'thermometer' ),
		array( 'ion-speedometer' => 'speedometer' ),
		array( 'ion-model-s' => 'model-s' ),
		array( 'ion-plane' => 'plane' ),
		array( 'ion-jet' => 'jet' ),
		array( 'ion-load-a' => 'load-a' ),
		array( 'ion-load-b' => 'load-b' ),
		array( 'ion-load-c' => 'load-c' ),
		array( 'ion-load-d' => 'load-d' ),
		array( 'ion-ios-ionic-outline' => 'ios-ionic-outline' ),
		array( 'ion-ios-arrow-back' => 'ios-arrow-back' ),
		array( 'ion-ios-arrow-forward' => 'ios-arrow-forward' ),
		array( 'ion-ios-arrow-up' => 'ios-arrow-up' ),
		array( 'ion-ios-arrow-right' => 'ios-arrow-right' ),
		array( 'ion-ios-arrow-down' => 'ios-arrow-down' ),
		array( 'ion-ios-arrow-left' => 'ios-arrow-left' ),
		array( 'ion-ios-arrow-thin-up' => 'ios-arrow-thin-up' ),
		array( 'ion-ios-arrow-thin-right' => 'ios-arrow-thin-right' ),
		array( 'ion-ios-arrow-thin-down' => 'ios-arrow-thin-down' ),
		array( 'ion-ios-arrow-thin-left' => 'ios-arrow-thin-left' ),
		array( 'ion-ios-circle-filled' => 'ios-circle-filled' ),
		array( 'ion-ios-circle-outline' => 'ios-circle-outline' ),
		array( 'ion-ios-checkmark-empty' => 'ios-checkmark-empty' ),
		array( 'ion-ios-checkmark-outline' => 'ios-checkmark-outline' ),
		array( 'ion-ios-checkmark' => 'ios-checkmark' ),
		array( 'ion-ios-plus-empty' => 'ios-plus-empty' ),
		array( 'ion-ios-plus-outline' => 'ios-plus-outline' ),
		array( 'ion-ios-plus' => 'ios-plus' ),
		array( 'ion-ios-close-empty' => 'ios-close-empty' ),
		array( 'ion-ios-close-outline' => 'ios-close-outline' ),
		array( 'ion-ios-close' => 'ios-close' ),
		array( 'ion-ios-minus-empty' => 'ios-minus-empty' ),
		array( 'ion-ios-minus-outline' => 'ios-minus-outline' ),
		array( 'ion-ios-minus' => 'ios-minus' ),
		array( 'ion-ios-information-empty' => 'ios-information-empty' ),
		array( 'ion-ios-information-outline' => 'ios-information-outline' ),
		array( 'ion-ios-information' => 'ios-information' ),
		array( 'ion-ios-help-empty' => 'ios-help-empty' ),
		array( 'ion-ios-help-outline' => 'ios-help-outline' ),
		array( 'ion-ios-help' => 'ios-help' ),
		array( 'ion-ios-search' => 'ios-search' ),
		array( 'ion-ios-search-strong' => 'ios-search-strong' ),
		array( 'ion-ios-star' => 'ios-star' ),
		array( 'ion-ios-star-half' => 'ios-star-half' ),
		array( 'ion-ios-star-outline' => 'ios-star-outline' ),
		array( 'ion-ios-heart' => 'ios-heart' ),
		array( 'ion-ios-heart-outline' => 'ios-heart-outline' ),
		array( 'ion-ios-more' => 'ios-more' ),
		array( 'ion-ios-more-outline' => 'ios-more-outline' ),
		array( 'ion-ios-home' => 'ios-home' ),
		array( 'ion-ios-home-outline' => 'ios-home-outline' ),
		array( 'ion-ios-cloud' => 'ios-cloud' ),
		array( 'ion-ios-cloud-outline' => 'ios-cloud-outline' ),
		array( 'ion-ios-cloud-upload' => 'ios-cloud-upload' ),
		array( 'ion-ios-cloud-upload-outline' => 'ios-cloud-upload-outline' ),
		array( 'ion-ios-cloud-download' => 'ios-cloud-download' ),
		array( 'ion-ios-cloud-download-outline' => 'ios-cloud-download-outline' ),
		array( 'ion-ios-upload' => 'ios-upload' ),
		array( 'ion-ios-upload-outline' => 'ios-upload-outline' ),
		array( 'ion-ios-download' => 'ios-download' ),
		array( 'ion-ios-download-outline' => 'ios-download-outline' ),
		array( 'ion-ios-refresh' => 'ios-refresh' ),
		array( 'ion-ios-refresh-outline' => 'ios-refresh-outline' ),
		array( 'ion-ios-refresh-empty' => 'ios-refresh-empty' ),
		array( 'ion-ios-reload' => 'ios-reload' ),
		array( 'ion-ios-loop-strong' => 'ios-loop-strong' ),
		array( 'ion-ios-loop' => 'ios-loop' ),
		array( 'ion-ios-bookmarks' => 'ios-bookmarks' ),
		array( 'ion-ios-bookmarks-outline' => 'ios-bookmarks-outline' ),
		array( 'ion-ios-book' => 'ios-book' ),
		array( 'ion-ios-book-outline' => 'ios-book-outline' ),
		array( 'ion-ios-flag' => 'ios-flag' ),
		array( 'ion-ios-flag-outline' => 'ios-flag-outline' ),
		array( 'ion-ios-glasses' => 'ios-glasses' ),
		array( 'ion-ios-glasses-outline' => 'ios-glasses-outline' ),
		array( 'ion-ios-browsers' => 'ios-browsers' ),
		array( 'ion-ios-browsers-outline' => 'ios-browsers-outline' ),
		array( 'ion-ios-at' => 'ios-at' ),
		array( 'ion-ios-at-outline' => 'ios-at-outline' ),
		array( 'ion-ios-pricetag' => 'ios-pricetag' ),
		array( 'ion-ios-pricetag-outline' => 'ios-pricetag-outline' ),
		array( 'ion-ios-pricetags' => 'ios-pricetags' ),
		array( 'ion-ios-pricetags-outline' => 'ios-pricetags-outline' ),
		array( 'ion-ios-cart' => 'ios-cart' ),
		array( 'ion-ios-cart-outline' => 'ios-cart-outline' ),
		array( 'ion-ios-chatboxes' => 'ios-chatboxes' ),
		array( 'ion-ios-chatboxes-outline' => 'ios-chatboxes-outline' ),
		array( 'ion-ios-chatbubble' => 'ios-chatbubble' ),
		array( 'ion-ios-chatbubble-outline' => 'ios-chatbubble-outline' ),
		array( 'ion-ios-cog' => 'ios-cog' ),
		array( 'ion-ios-cog-outline' => 'ios-cog-outline' ),
		array( 'ion-ios-gear' => 'ios-gear' ),
		array( 'ion-ios-gear-outline' => 'ios-gear-outline' ),
		array( 'ion-ios-settings' => 'ios-settings' ),
		array( 'ion-ios-settings-strong' => 'ios-settings-strong' ),
		array( 'ion-ios-toggle' => 'ios-toggle' ),
		array( 'ion-ios-toggle-outline' => 'ios-toggle-outline' ),
		array( 'ion-ios-analytics' => 'ios-analytics' ),
		array( 'ion-ios-analytics-outline' => 'ios-analytics-outline' ),
		array( 'ion-ios-pie' => 'ios-pie' ),
		array( 'ion-ios-pie-outline' => 'ios-pie-outline' ),
		array( 'ion-ios-pulse' => 'ios-pulse' ),
		array( 'ion-ios-pulse-strong' => 'ios-pulse-strong' ),
		array( 'ion-ios-filing' => 'ios-filing' ),
		array( 'ion-ios-filing-outline' => 'ios-filing-outline' ),
		array( 'ion-ios-box' => 'ios-box' ),
		array( 'ion-ios-box-outline' => 'ios-box-outline' ),
		array( 'ion-ios-compose' => 'ios-compose' ),
		array( 'ion-ios-compose-outline' => 'ios-compose-outline' ),
		array( 'ion-ios-trash' => 'ios-trash' ),
		array( 'ion-ios-trash-outline' => 'ios-trash-outline' ),
		array( 'ion-ios-copy' => 'ios-copy' ),
		array( 'ion-ios-copy-outline' => 'ios-copy-outline' ),
		array( 'ion-ios-email' => 'ios-email' ),
		array( 'ion-ios-email-outline' => 'ios-email-outline' ),
		array( 'ion-ios-undo' => 'ios-undo' ),
		array( 'ion-ios-undo-outline' => 'ios-undo-outline' ),
		array( 'ion-ios-redo' => 'ios-redo' ),
		array( 'ion-ios-redo-outline' => 'ios-redo-outline' ),
		array( 'ion-ios-paperplane' => 'ios-paperplane' ),
		array( 'ion-ios-paperplane-outline' => 'ios-paperplane-outline' ),
		array( 'ion-ios-folder' => 'ios-folder' ),
		array( 'ion-ios-folder-outline' => 'ios-folder-outline' ),
		array( 'ion-ios-paper' => 'ios-paper' ),
		array( 'ion-ios-paper-outline' => 'ios-paper-outline' ),
		array( 'ion-ios-list' => 'ios-list' ),
		array( 'ion-ios-list-outline' => 'ios-list-outline' ),
		array( 'ion-ios-world' => 'ios-world' ),
		array( 'ion-ios-world-outline' => 'ios-world-outline' ),
		array( 'ion-ios-alarm' => 'ios-alarm' ),
		array( 'ion-ios-alarm-outline' => 'ios-alarm-outline' ),
		array( 'ion-ios-speedometer' => 'ios-speedometer' ),
		array( 'ion-ios-speedometer-outline' => 'ios-speedometer-outline' ),
		array( 'ion-ios-stopwatch' => 'ios-stopwatch' ),
		array( 'ion-ios-stopwatch-outline' => 'ios-stopwatch-outline' ),
		array( 'ion-ios-timer' => 'ios-timer' ),
		array( 'ion-ios-timer-outline' => 'ios-timer-outline' ),
		array( 'ion-ios-clock' => 'ios-clock' ),
		array( 'ion-ios-clock-outline' => 'ios-clock-outline' ),
		array( 'ion-ios-time' => 'ios-time' ),
		array( 'ion-ios-time-outline' => 'ios-time-outline' ),
		array( 'ion-ios-calendar' => 'ios-calendar' ),
		array( 'ion-ios-calendar-outline' => 'ios-calendar-outline' ),
		array( 'ion-ios-photos' => 'ios-photos' ),
		array( 'ion-ios-photos-outline' => 'ios-photos-outline' ),
		array( 'ion-ios-albums' => 'ios-albums' ),
		array( 'ion-ios-albums-outline' => 'ios-albums-outline' ),
		array( 'ion-ios-camera' => 'ios-camera' ),
		array( 'ion-ios-camera-outline' => 'ios-camera-outline' ),
		array( 'ion-ios-reverse-camera' => 'ios-reverse-camera' ),
		array( 'ion-ios-reverse-camera-outline' => 'ios-reverse-camera-outline' ),
		array( 'ion-ios-eye' => 'ios-eye' ),
		array( 'ion-ios-eye-outline' => 'ios-eye-outline' ),
		array( 'ion-ios-bolt' => 'ios-bolt' ),
		array( 'ion-ios-bolt-outline' => 'ios-bolt-outline' ),
		array( 'ion-ios-color-wand' => 'ios-color-wand' ),
		array( 'ion-ios-color-wand-outline' => 'ios-color-wand-outline' ),
		array( 'ion-ios-color-filter' => 'ios-color-filter' ),
		array( 'ion-ios-color-filter-outline' => 'ios-color-filter-outline' ),
		array( 'ion-ios-grid-view' => 'ios-grid-view' ),
		array( 'ion-ios-grid-view-outline' => 'ios-grid-view-outline' ),
		array( 'ion-ios-crop-strong' => 'ios-crop-strong' ),
		array( 'ion-ios-crop' => 'ios-crop' ),
		array( 'ion-ios-barcode' => 'ios-barcode' ),
		array( 'ion-ios-barcode-outline' => 'ios-barcode-outline' ),
		array( 'ion-ios-briefcase' => 'ios-briefcase' ),
		array( 'ion-ios-briefcase-outline' => 'ios-briefcase-outline' ),
		array( 'ion-ios-medkit' => 'ios-medkit' ),
		array( 'ion-ios-medkit-outline' => 'ios-medkit-outline' ),
		array( 'ion-ios-medical' => 'ios-medical' ),
		array( 'ion-ios-medical-outline' => 'ios-medical-outline' ),
		array( 'ion-ios-infinite' => 'ios-infinite' ),
		array( 'ion-ios-infinite-outline' => 'ios-infinite-outline' ),
		array( 'ion-ios-calculator' => 'ios-calculator' ),
		array( 'ion-ios-calculator-outline' => 'ios-calculator-outline' ),
		array( 'ion-ios-keypad' => 'ios-keypad' ),
		array( 'ion-ios-keypad-outline' => 'ios-keypad-outline' ),
		array( 'ion-ios-telephone' => 'ios-telephone' ),
		array( 'ion-ios-telephone-outline' => 'ios-telephone-outline' ),
		array( 'ion-ios-drag' => 'ios-drag' ),
		array( 'ion-ios-location' => 'ios-location' ),
		array( 'ion-ios-location-outline' => 'ios-location-outline' ),
		array( 'ion-ios-navigate' => 'ios-navigate' ),
		array( 'ion-ios-navigate-outline' => 'ios-navigate-outline' ),
		array( 'ion-ios-locked' => 'ios-locked' ),
		array( 'ion-ios-locked-outline' => 'ios-locked-outline' ),
		array( 'ion-ios-unlocked' => 'ios-unlocked' ),
		array( 'ion-ios-unlocked-outline' => 'ios-unlocked-outline' ),
		array( 'ion-ios-monitor' => 'ios-monitor' ),
		array( 'ion-ios-monitor-outline' => 'ios-monitor-outline' ),
		array( 'ion-ios-printer' => 'ios-printer' ),
		array( 'ion-ios-printer-outline' => 'ios-printer-outline' ),
		array( 'ion-ios-game-controller-a' => 'ios-game-controller-a' ),
		array( 'ion-ios-game-controller-a-outline' => 'ios-game-controller-a-outline' ),
		array( 'ion-ios-game-controller-b' => 'ios-game-controller-b' ),
		array( 'ion-ios-game-controller-b-outline' => 'ios-game-controller-b-outline' ),
		array( 'ion-ios-americanfootball' => 'ios-americanfootball' ),
		array( 'ion-ios-americanfootball-outline' => 'ios-americanfootball-outline' ),
		array( 'ion-ios-baseball' => 'ios-baseball' ),
		array( 'ion-ios-baseball-outline' => 'ios-baseball-outline' ),
		array( 'ion-ios-basketball' => 'ios-basketball' ),
		array( 'ion-ios-basketball-outline' => 'ios-basketball-outline' ),
		array( 'ion-ios-tennisball' => 'ios-tennisball' ),
		array( 'ion-ios-tennisball-outline' => 'ios-tennisball-outline' ),
		array( 'ion-ios-football' => 'ios-football' ),
		array( 'ion-ios-football-outline' => 'ios-football-outline' ),
		array( 'ion-ios-body' => 'ios-body' ),
		array( 'ion-ios-body-outline' => 'ios-body-outline' ),
		array( 'ion-ios-person' => 'ios-person' ),
		array( 'ion-ios-person-outline' => 'ios-person-outline' ),
		array( 'ion-ios-personadd' => 'ios-personadd' ),
		array( 'ion-ios-personadd-outline' => 'ios-personadd-outline' ),
		array( 'ion-ios-people' => 'ios-people' ),
		array( 'ion-ios-people-outline' => 'ios-people-outline' ),
		array( 'ion-ios-musical-notes' => 'ios-musical-notes' ),
		array( 'ion-ios-musical-note' => 'ios-musical-note' ),
		array( 'ion-ios-bell' => 'ios-bell' ),
		array( 'ion-ios-bell-outline' => 'ios-bell-outline' ),
		array( 'ion-ios-mic' => 'ios-mic' ),
		array( 'ion-ios-mic-outline' => 'ios-mic-outline' ),
		array( 'ion-ios-mic-off' => 'ios-mic-off' ),
		array( 'ion-ios-volume-high' => 'ios-volume-high' ),
		array( 'ion-ios-volume-low' => 'ios-volume-low' ),
		array( 'ion-ios-play' => 'ios-play' ),
		array( 'ion-ios-play-outline' => 'ios-play-outline' ),
		array( 'ion-ios-pause' => 'ios-pause' ),
		array( 'ion-ios-pause-outline' => 'ios-pause-outline' ),
		array( 'ion-ios-recording' => 'ios-recording' ),
		array( 'ion-ios-recording-outline' => 'ios-recording-outline' ),
		array( 'ion-ios-fastforward' => 'ios-fastforward' ),
		array( 'ion-ios-fastforward-outline' => 'ios-fastforward-outline' ),
		array( 'ion-ios-rewind' => 'ios-rewind' ),
		array( 'ion-ios-rewind-outline' => 'ios-rewind-outline' ),
		array( 'ion-ios-skipbackward' => 'ios-skipbackward' ),
		array( 'ion-ios-skipbackward-outline' => 'ios-skipbackward-outline' ),
		array( 'ion-ios-skipforward' => 'ios-skipforward' ),
		array( 'ion-ios-skipforward-outline' => 'ios-skipforward-outline' ),
		array( 'ion-ios-shuffle-strong' => 'ios-shuffle-strong' ),
		array( 'ion-ios-shuffle' => 'ios-shuffle' ),
		array( 'ion-ios-videocam' => 'ios-videocam' ),
		array( 'ion-ios-videocam-outline' => 'ios-videocam-outline' ),
		array( 'ion-ios-film' => 'ios-film' ),
		array( 'ion-ios-film-outline' => 'ios-film-outline' ),
		array( 'ion-ios-flask' => 'ios-flask' ),
		array( 'ion-ios-flask-outline' => 'ios-flask-outline' ),
		array( 'ion-ios-lightbulb' => 'ios-lightbulb' ),
		array( 'ion-ios-lightbulb-outline' => 'ios-lightbulb-outline' ),
		array( 'ion-ios-wineglass' => 'ios-wineglass' ),
		array( 'ion-ios-wineglass-outline' => 'ios-wineglass-outline' ),
		array( 'ion-ios-pint' => 'ios-pint' ),
		array( 'ion-ios-pint-outline' => 'ios-pint-outline' ),
		array( 'ion-ios-nutrition' => 'ios-nutrition' ),
		array( 'ion-ios-nutrition-outline' => 'ios-nutrition-outline' ),
		array( 'ion-ios-flower' => 'ios-flower' ),
		array( 'ion-ios-flower-outline' => 'ios-flower-outline' ),
		array( 'ion-ios-rose' => 'ios-rose' ),

	);

	return array_merge( $icons, $ion_icons );
}

?>
