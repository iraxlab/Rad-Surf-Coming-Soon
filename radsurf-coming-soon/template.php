<?php if ( ! defined( 'ABSPATH' ) ) exit;
$form_id = (int) get_option( 'radsurf_cs_form_id', 0 );
$ig = get_option( 'radsurf_cs_instagram', 'https://www.instagram.com/radsurfnoflo' );
$fb = get_option( 'radsurf_cs_facebook', 'https://www.facebook.com/profile.php?id=61553354830685' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rad Surf Co. · Coming Soon</title>
<meta name="description" content="Rad Surf Company is a North Florida surf brand making snapback patch hats, die-cut surfer stickers and ocean-inspired apparel. Created and run by surfers. New site coming soon.">
<meta property="og:title" content="Rad Surf Co. · Coming Soon">
<meta property="og:description" content="Snapback patch hats, die-cut surfer stickers and ocean-inspired apparel. Created and run by surfers.">
<meta property="og:image" content="<?php echo esc_url( RADSURF_CS_URL . 'assets/logo.jpg' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anybody:wdth,wght@50..150,100..900&family=Instrument+Sans:wght@400;500;600;700&family=Instrument+Serif:ital@0;1&display=swap">
<?php wp_head(); /* loads WPForms scripts & styles */ ?>
<style>
html,body{margin:0!important;padding:0!important;height:100%;background:#06253b;-webkit-font-smoothing:antialiased}
#wpadminbar{display:none!important}
.rs{position:relative;min-height:100svh;overflow:hidden;color:#EEFAFB;font-family:'Instrument Sans',system-ui,sans-serif;background:linear-gradient(180deg,#1E6D93 0%,#7DC7DB 40%,#ffe2ad 55%,#1E6D93 56%,#0e4868 100%)}
.rs canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
.rs a{color:#EEFAFB;text-decoration:none}
.rs-wrap{position:relative;z-index:2;min-height:100svh;box-sizing:border-box;display:flex;flex-direction:column;justify-content:space-between;gap:28px;padding:28px clamp(20px,5vw,80px)}
.rs-head{display:flex;justify-content:space-between;align-items:center;gap:16px}
.rs-logo{display:inline-flex;background:#fff;border-radius:18px;padding:8px 14px;box-shadow:0 16px 34px -18px rgba(6,37,59,.6)}
.rs-logo img{height:48px;width:auto;display:block}
.rs-pill{font-size:15px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;padding:11px 18px;border:1.5px solid rgba(238,250,251,.8);border-radius:999px;background:rgba(6,37,59,.18);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.rs-main{display:flex;flex-direction:column;gap:clamp(18px,2.4vh,30px);max-width:1100px;text-shadow:0 2px 30px rgba(6,37,59,.35)}
.rs-eye{display:flex;align-items:center;gap:10px;font-size:15px;font-weight:700;letter-spacing:.2em;text-transform:uppercase}
.rs-eye i{width:10px;height:10px;border-radius:50%;background:#ffd38a;box-shadow:0 0 0 5px rgba(255,211,138,.3),0 0 22px #ffd38a}
.rs h1{margin:0;font-family:'Anybody',sans-serif;font-weight:900;font-stretch:130%;font-size:clamp(56px,min(11vw,17vh),196px);line-height:.86;letter-spacing:-0.025em;color:#EEFAFB}
.rs h1 .w{display:inline-flex;white-space:nowrap}
.rs h1 .ws{display:flex;flex-wrap:wrap;column-gap:.2em}
.rs h1 .l{display:inline-block;animation:rsl 3.2s ease-in-out infinite}
.rs h1 em{display:block;font-family:'Instrument Serif',serif;font-weight:400;font-stretch:100%;font-size:.62em;letter-spacing:-0.01em;line-height:1;margin-top:.12em;color:#fff}
.rs p{margin:0;max-width:600px;font-size:clamp(19px,1.6vw,23px);line-height:1.5;font-weight:600}
.rs-by{font-family:'Instrument Serif',serif;font-style:italic;font-size:clamp(24px,2.2vw,32px);line-height:1;color:#fff}
.rs-form{max-width:620px;text-shadow:none}
/* ---- WPForms restyle ---- */
.rs-form .wpforms-container{margin:0!important}
.rs-form .wpforms-form{display:flex!important;flex-wrap:wrap;gap:8px;align-items:center;padding:8px!important;border-radius:999px;background:rgba(238,250,251,.95);box-shadow:0 24px 50px -24px rgba(6,37,59,.7)}
.rs-form .wpforms-field-container{flex:1 1 200px;min-width:0}
.rs-form .wpforms-field{padding:0!important;margin:0!important}
.rs-form .wpforms-field-label{position:absolute!important;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0)}
.rs-form input[type=email],.rs-form input[type=text]{width:100%!important;max-width:none!important;height:auto!important;border:0!important;outline:none!important;box-shadow:none!important;background:transparent!important;font:600 18px 'Instrument Sans',sans-serif!important;color:#06253b!important;padding:14px 18px!important}
.rs-form input::placeholder{color:rgba(6,37,59,.55)!important}
.rs-form .wpforms-submit-container{padding:0!important;margin:0!important}
.rs-form button[type=submit]{border:0!important;cursor:pointer;background:#0e4868!important;color:#EEFAFB!important;font:700 16px 'Instrument Sans',sans-serif!important;letter-spacing:.06em;padding:16px 26px!important;height:auto!important;border-radius:999px!important;transition:background .25s,transform .25s}
.rs-form button[type=submit]:hover{background:#1E6D93!important;transform:translateY(-2px)}
.rs-form label.wpforms-error,.rs-form em.wpforms-error{position:absolute;margin-top:6px;color:#ffd38a!important;font-size:15px!important;padding-left:18px}
.rs-form .wpforms-confirmation-container-full,.rs-form .rs-done{display:flex;align-items:center;gap:14px;padding:16px 24px!important;margin:0!important;border:0!important;border-radius:999px;background:rgba(238,250,251,.95)!important;color:#06253b!important;font:700 18px 'Instrument Sans',sans-serif}
.rs-form .rs-done em{font-family:'Instrument Serif',serif;font-weight:400;font-size:28px}
.rs-missing{padding:16px 22px;border-radius:20px;background:rgba(6,37,59,.5);font-size:16px}
.rs-foot{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
.rs-foot .soc{display:flex;gap:10px;flex-wrap:wrap}
.rs-btn{display:inline-flex;align-items:center;gap:10px;padding:11px 18px;border-radius:999px;border:1.5px solid rgba(238,250,251,.75);background:rgba(6,37,59,.25);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);color:#EEFAFB;font:700 15px 'Instrument Sans',sans-serif;letter-spacing:.06em;cursor:pointer}
.rs-btn:hover{background:rgba(6,37,59,.5)}
.rs-in{opacity:0;animation:rsr 1.1s cubic-bezier(.2,.7,.2,1) forwards}
@keyframes rsr{from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:none}}
@keyframes rsl{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-.06em) rotate(-2deg)}}
@media (prefers-reduced-motion:reduce){.rs h1 .l{animation:none}.rs-in{animation:none;opacity:1}}
@media (max-width:640px){.rs-wrap{padding-top:22px;justify-content:flex-start}.rs-pill{display:none}.rs-form .wpforms-form{border-radius:28px}.rs-form button[type=submit]{width:100%}}
</style>
</head>
<body>
<div class="rs">
	<canvas id="rs-sea"></canvas>
	<div class="rs-wrap">
		<header class="rs-head rs-in" style="animation-delay:.1s">
			<span class="rs-logo"><img src="<?php echo esc_url( RADSURF_CS_URL . 'assets/logo.jpg' ); ?>" alt="Rad Surf Co."></span>
			<span class="rs-pill">North Florida · Surf Co.</span>
		</header>
		<main class="rs-main">
			<span class="rs-eye rs-in" style="animation-delay:.25s"><i></i>Coming soon</span>
			<h1 class="rs-in" style="animation-delay:.4s">
				<span class="ws">
					<span class="w"><?php foreach ( str_split( 'Something' ) as $i => $c ) echo '<span class="l" style="animation-delay:' . ( $i * 0.12 ) . 's">' . esc_html( $c ) . '</span>'; ?></span>
					<span class="w"><?php foreach ( str_split( 'rad' ) as $i => $c ) echo '<span class="l" style="animation-delay:' . ( ( $i + 9 ) * 0.12 ) . 's">' . esc_html( $c ) . '</span>'; ?></span>
				</span>
				<em>is paddling out.</em>
			</h1>
			<p class="rs-in" style="animation-delay:.6s">Our new home for snapback patch hats, die-cut surfer stickers and ocean-inspired apparel. Get on the list and be first in the water when we drop.</p>
			<span class="rs-by rs-in" style="animation-delay:.7s">Created and run by surfers.</span>
			<div class="rs-form rs-in" style="animation-delay:.9s">
				<?php if ( $form_id && shortcode_exists( 'wpforms' ) ) {
					echo do_shortcode( '[wpforms id="' . $form_id . '" title="false" description="false"]' );
				} elseif ( current_user_can( 'manage_options' ) ) {
					echo '<div class="rs-missing">Add your WPForms form ID in Settings → Rad Surf Coming Soon.</div>';
				} ?>
			</div>
		</main>
		<footer class="rs-foot rs-in" style="animation-delay:1.05s">
			<div class="soc">
				<?php if ( $ig ) : ?><a class="rs-btn" href="<?php echo esc_url( $ig ); ?>" target="_blank" rel="noopener">INSTAGRAM</a><?php endif; ?>
				<?php if ( $fb ) : ?><a class="rs-btn" href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener">FACEBOOK</a><?php endif; ?>
			</div>
			<button class="rs-btn" id="rs-sound" type="button">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 9v6h4l5 4V5L8 9H4z"/><path d="M16.5 8.5a5 5 0 0 1 0 7"/></svg>
				<span>HEAR THE WAVES</span>
			</button>
		</footer>
	</div>
</div>
<script>window.RADSURF_CS_AUDIO = <?php echo wp_json_encode( RADSURF_CS_URL . 'assets/ocean-waves.mp3' ); ?>;</script>
<script src="<?php echo esc_url( RADSURF_CS_URL . 'assets/coming-soon.js' ); ?>"></script>
<?php wp_footer(); ?>
</body>
</html>
