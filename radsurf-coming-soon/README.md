# Rad Surf Coming Soon — how to use it safely

This is a small **plugin**, not a theme. It does NOT change your theme, products, WooCommerce, pages or WPForms. Turning it off = site back exactly as it was.

- **Visitors** see the coming soon page.
- **You (logged in)** keep seeing and building the real site.
- Google gets a "temporarily closed" signal (503), so your rankings are protected.
- WooCommerce payment callbacks, WPForms and the login page keep working.

## 1. Create the WPForms sign-up form
1. WPForms → Add New → **Blank Form** → name it "Coming Soon".
2. Add one field: **Email**. Click it → set **Placeholder** to `Your email`, mark it **Required**.
3. Settings → General → **Submit Button Text**: `NOTIFY ME →`
4. Settings → Notifications → send to your email (you get each signup).
5. Settings → Confirmations → type **Message** (any text — the plugin shows "You're on the list. Stay rad.").
6. Save. Note the **form ID** (the number in `[wpforms id="123"]`).

Tip: with WPForms Pro you can also connect the form to Mailchimp / Constant Contact under Marketing.

## 2. Install the plugin
1. Plugins → Add New → **Upload Plugin** → choose `radsurf-coming-soon.zip` → Install → **Activate**.
2. Settings → **Rad Surf Coming Soon**:
   - Enter the **WPForms form ID**
   - Check Instagram / Facebook links
   - Click **Preview coming soon page** to check it
   - When happy, tick **Coming soon mode: ON** → Save

You'll see "🌊 Coming soon is ON" in the black admin bar as a reminder.

## 3. Check it like a visitor
Open the site in a **private / incognito window** (you're logged out there). You should see the coming soon page. Submit a test email → it appears in WPForms → Entries (Pro) and arrives in your inbox.

## 4. Launch day
Settings → Rad Surf Coming Soon → untick **ON** → Save. Clear your cache plugin. Done. Delete the plugin later if you like.

## If you use a cache plugin
After turning it ON or OFF, clear the cache (WP Rocket / LiteSpeed / SiteGround Optimizer → "Purge all"), or visitors may see the old version for a while.
