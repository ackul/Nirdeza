function GetCookie (name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
      var j = i + alen;
      if (document.cookie.substring(i, j) == arg)
        return getCookieVal (j);
      i = document.cookie.indexOf(" ", i) + 1;
      if (i == 0) break;
    }
    return null;
  }
  function SetCookie (name,value,expires,path,domain,secure) {
    document.cookie = name + "=" + escape (value) +
      ((expires) ? "; expires=" + expires.toGMTString() : "") +
      ((path) ? "; path=" + path : "") +
      ((domain) ? "; domain=" + domain : "") +
      ((secure) ? "; secure" : "");
  }
  function getCookieVal (offset) {
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1)
      endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
  }
 	function enc(message)
	{
		while (key.length < 24){key += "e";}
		var ciphertext = des (key, message, 1, 0, null);
		return stringToHex(ciphertext);
	}
 	function relo()
	{
		var jetzt = new Date();
		self.open("startpage.php?time="+jetzt.getTime(), "Hp");
	}
	function co()
	{
	if(document.login_form.save.checked == true)
		{
		var BN = document.login_form.BN.value;
		var HO = document.login_form.HO.value;
		var DB = document.login_form.DB.value;
		var cookies = document.login_form.Cookie.checked?1:0;
		var ip_check = document.login_form.IP.checked?1:0;
		var use_time_limit = document.login_form.use_time.checked?1:0;
		var time_limit = document.login_form.time.value;
		if(BN != null){document.cookie = SetCookie("Bn", BN);}
		if(HO != null){document.cookie = SetCookie("Ho", HO);}
		if(DB != null){document.cookie = SetCookie("DB", DB);}
		if(cookies != null){document.cookie = SetCookie("cookies", cookies);}
		if(ip_check != null){document.cookie = SetCookie("ip_check", ip_check);}
		if(use_time_limit != null){document.cookie = SetCookie("use_time_limit", use_time_limit);}
		if(time_limit != null){document.cookie = SetCookie("time_limit", time_limit);}
		if(document.login_form.type[1] && document.login_form.type[1].checked){document.cookie = SetCookie("Type", "st");}
		else{document.cookie = SetCookie("Type", "sql");}
	}
	else
	{
		document.cookie = SetCookie("Bn", "");
		document.cookie = SetCookie("Ho", "");
		document.cookie = SetCookie("DB", "");
		document.cookie = SetCookie("Type", "");
		document.cookie = SetCookie("time_limit", "");
		document.cookie = SetCookie("use_time_limit", "");
		document.cookie = SetCookie("ip_check", "");
		document.cookie = SetCookie("cookies", "");
	}
	document.login_form.PW.value = enc(document.login_form.password.value)
	return true;
}
	function read()
	{
		if(GetCookie("Type") == "st"){
			document.login_form.type[1].checked = true;
			document.login_form.HO.disabled = true;
			document.login_form.DB.disabled = true;
		}
		if(GetCookie("Bn"))var BN = GetCookie("Bn");
		if(GetCookie("Ho"))var HO = GetCookie("Ho");
		if(GetCookie("DB"))var DB = GetCookie("DB");
		if(GetCookie("coookies"))var cookies = GetCookie("cookies");
		if(GetCookie("use_time_limit"))var use_time_limit = GetCookie("use_time_limit");
		if(GetCookie("time_limit"))var time_limit = GetCookie("time_limit");
		if(GetCookie("ip_check"))var ip_check = GetCookie("ip_check");
		if(BN != null){document.login_form.BN.value = BN;}
		if(HO != null){document.login_form.HO.value = HO;}
		if(DB != null){document.login_form.DB.value = DB;}
		if(cookies != null){document.login_form.Cookie.checked = (cookies==1)?true:false;}
		if(use_time_limit != null){document.login_form.use_time.checked = (use_time_limit==1)?true:false;}
		if(time_limit != null){document.login_form.time.value = time_limit;}
		if(ip_check != null){document.login_form.IP.checked = (ip_check==1)?true:false;}
	}
	function rel()
	{
		location.reload();
	}