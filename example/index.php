<HTML>
<HEAD>
	<TITLE>Auth Armor PHP Demo</TITLE>
	<script src="https://cdn.autharmor.com/scripts/autharmor-sdk.js"></script>
</HEAD>
<style>
.content {
	max-width: 500px;
	margin: auto;
	text-align: center;
	color: 
}
</style>
<BODY>
<script>

// Initialize the SDK
const SDK = new AuthArmorSDK("https://myapidomain/");

const register = async (username) => {
	// Generate a new invite
	const invite = await SDK.invite.generateInviteCode({
		nickname: username, // Specify the invite's nickname
		referenceId: "myreference" // Specify a reference ID for the invite
	});
	console.log("Getting invite QR code and link.");
	document.getElementById("auth_profile_id").value = invite.auth_profile_id;
	document.getElementById("qrcode").src = invite.getQRCode();
	document.getElementById("login_success").style.visibility = "hidden";
	document.getElementById("qrcode_and_link").style.visibility = "initial";
	document.getElementById("invite_link").href = invite.getInviteLink();
};

const confirm = async (auth_profile_id) => {
	// Confirm an invite
	console.log("Confirming invite ID:", auth_profile_id);
	await SDK.invite.confirmInvite(auth_profile_id);
	console.log("Invite has been confirmed successfully!");
	document.getElementById("login_success").style.visibility = "hidden";
	document.getElementById("qrcode_and_link").style.visibility = "hidden";
	document.getElementById("confirm_success").style.visibility = "initial";
};

const authenticate = async (username) => {
	// Perform an authentication
	try {
		console.log("Authenticating user:", username);
		await SDK.auth.authenticate(username);
		console.log("User authenticated!");
		document.getElementById("qrcode_and_link").style.visibility = "hidden";
		document.getElementById("confirm_success").style.visibility = "hidden";
		document.getElementById("login_success").style.visibility = "initial";
	} catch (err) {
		console.error("The request was declined or has timed out!", err);
	}
};

</script>
<div class="content">
<h3>AuthArmor Demo</h3>
<input id="username" type="text" value="" /><br />
<input id="login" type="button" value="Login" onClick="authenticate(document.getElementById('username').value);" /> <input id="register" type="button" value="Register" onClick="register(document.getElementById('username').value);" /><br />
<br />
<br />

<div id="login_success" style="visibility: hidden;">
You were logged in successfully!
</div>

<div id="qrcode_and_link" style="visibility: hidden;">
<input id="auth_profile_id" type="hidden" value="" />
<img id="qrcode" src="" /><br />
<br />
Use the AuthArmor mobile app to scan this QR Code<br />
-or-<br />
<a id="invite_link" target="_blank" href="">Click here</a><br />
<br />
Once enrolled, press the Confirm Invite button<br />
<br />
<input id="confirm_invite" type="button" value="Confirm Invite" onClick="confirm(document.getElementById('auth_profile_id').value);" />
</div>

<div id="confirm_success" style="visibility: hidden;">
Your invite has been confirmed!
</div>

</div>
</BODY>
</HTML>
