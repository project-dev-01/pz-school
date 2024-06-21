
var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var browserName = navigator.appName;
var fullVersion = '' + parseFloat(navigator.appVersion);
var majorVersion = parseInt(navigator.appVersion, 10);
var nameOffset, verOffset, ix;
var device = (window.orientation > 1) ? 'Mobile' : 'PC';

// In Opera, the true version is after "OPR" or after "Version"
if ((verOffset = nAgt.indexOf("OPR")) != -1) {
   browserName = "Opera";
   fullVersion = nAgt.substring(verOffset + 4);
   if ((verOffset = nAgt.indexOf("Version")) != -1)
      fullVersion = nAgt.substring(verOffset + 8);
}
// In MS Edge, the true version is after "Edg" in userAgent
else if ((verOffset = nAgt.indexOf("Edg")) != -1) {
   browserName = "Microsoft Edge";
   fullVersion = nAgt.substring(verOffset + 4);
}
// In MSIE, the true version is after "MSIE" in userAgent
else if ((verOffset = nAgt.indexOf("MSIE")) != -1) {
   browserName = "Microsoft Internet Explorer";
   fullVersion = nAgt.substring(verOffset + 5);
}
// In Chrome, the true version is after "Chrome" 
else if ((verOffset = nAgt.indexOf("Chrome")) != -1) {
   browserName = "Chrome";
   fullVersion = nAgt.substring(verOffset + 7);
}
// In Safari, the true version is after "Safari" or after "Version" 
else if ((verOffset = nAgt.indexOf("Safari")) != -1) {
   browserName = "Safari";
   fullVersion = nAgt.substring(verOffset + 7);
   if ((verOffset = nAgt.indexOf("Version")) != -1)
      fullVersion = nAgt.substring(verOffset + 8);
}
// In Firefox, the true version is after "Firefox" 
else if ((verOffset = nAgt.indexOf("Firefox")) != -1) {
   browserName = "Firefox";
   fullVersion = nAgt.substring(verOffset + 8);
}
// In most other browsers, "name/version" is at the end of userAgent 
else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) <
   (verOffset = nAgt.lastIndexOf('/'))) {
   browserName = nAgt.substring(nameOffset, verOffset);
   fullVersion = nAgt.substring(verOffset + 1);
   if (browserName.toLowerCase() == browserName.toUpperCase()) {
      browserName = navigator.appName;
   }
}
// trim the fullVersion string at semicolon/space if present
if ((ix = fullVersion.indexOf(";")) != -1)
   fullVersion = fullVersion.substring(0, ix);
if ((ix = fullVersion.indexOf(" ")) != -1)
   fullVersion = fullVersion.substring(0, ix);

majorVersion = parseInt('' + fullVersion, 10);
if (isNaN(majorVersion)) {
   fullVersion = '' + parseFloat(navigator.appVersion);
   majorVersion = parseInt(navigator.appVersion, 10);
}



var OSName = "Unknown OS";
if (navigator.userAgent.indexOf("Win") != -1) OSName = "Windows";
if (navigator.userAgent.indexOf("Mac") != -1) OSName = "Macintosh";
if (navigator.userAgent.indexOf("Linux") != -1) OSName = "Linux";
if (navigator.userAgent.indexOf("Android") != -1) OSName = "Android";
if (navigator.userAgent.indexOf("like Mac") != -1) OSName = "iOS";

$('#user_browser').val(browserName + ' Version:' + fullVersion);
$('#user_os').val(OSName);
$('#user_device').val(device);