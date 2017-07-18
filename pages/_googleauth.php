<script type="text/javascript">
var clientId = '5851659241-7344218r6lr5vn70jjabeq290q9fb3lo.apps.googleusercontent.com';
var apiKey = 'AIzaSyAfM0jN7_sgFJJiLeA6xiWKGr9U0RPDAFA';
var scopes = 'https://www.google.com/m8/feeds';
var email;

function handleClientLoad() {
  // Loads the client library and the auth2 library together for efficiency.
  // Loading the auth2 library is optional here since `gapi.client.init` function will load
  // it if not already loaded. Loading it upfront can save one network request.
  gapi.load('client:auth2', initClient);
}

function initClient() {
  // Initialize the client with API key and People API, and initialize OAuth with an
  // OAuth 2.0 client ID and scopes (space delimited string) to request access.
  gapi.client.init({
      apiKey: apiKey,
      discoveryDocs: ["https://people.googleapis.com/$discovery/rest?version=v1"],
      clientId: clientId,
      hosted_domain: '<?php echo $_SESSION['domain_name'];?>',
      scope: 'profile'
  }).then(function () {

    // Listen for sign-in state changes.
    gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

    // Handle the initial sign-in state.
    updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
  });
}

function updateSigninStatus(isSignedIn) {
  // When signin status changes, this function is called.
  // If the signin status is changed to signedIn, we make an API call.
  if (isSignedIn) {

    makeApiCall();
  }
}

function handleSignInClick(event) {
  // Ideally the button should only show up after gapi.client.init finishes, so that this
  // handler won't be called before OAuth is initialized.
  gapi.auth2.getAuthInstance().signIn();
}

function handleSignOutClick(event) {
    gapi.auth2.getAuthInstance().signOut();
}

function makeApiCall() {
  // Make an API call to the People API, and print the user's given name.
  gapi.client.people.people.get({
          resourceName: 'people/me'
        }).then(function(response) {
          // console.log(response);
          var email = response.result.emailAddresses[0].value;
          var n = email.substr(email.indexOf("@") + 1);

          if(n === '<?php echo $_SESSION['domain_name'];?>'){
            var fname = response.result.names[0].givenName;
            var lname = response.result.names[0].familyName;
            var phone = response.result.phoneNumbers[0].canonicalForm;
            var dpm = response.result.organizations[0].department;
            var department = dpm.substr(0,dpm.indexOf(" "));
            document.getElementById("form_login").action = "new_user/check.php";
            document.getElementById("hd_email").value = email;
            document.getElementById("name").value = fname+' '+lname;
            document.getElementById("form_login").submit();
          }else {
            gapi.auth2.getAuthInstance().signOut();
            window.alert('กรุณาเข้าระบบด้วยอีเมล์ของ<?php echo $_SESSION['system_name'];?>');
            window.location.reload();
          }

        }, function(reason) {
          console.log('Error: ' + reason.result.error.message);
        });


}
</script>
<script async defer src="https://apis.google.com/js/api.js"
onload="this.onload=function(){};handleClientLoad()"
onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>
