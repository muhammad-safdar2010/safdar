var _field=0;
var _field_from=0;
var _field_to=0;
var _lease=0;
var _lease_from=0;
var _lease_to=0;
var _ag_pd=0;
// *** Information Regarding Data Selection 1st DDL *** 
	function srpt_enp_main_prod_dcat_ddl(str)
		{
			if (str=="")
				{
					document.getElementById("txtHint").innerHTML="";
					return;
				} 
			if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}
			else
				{// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
			xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
						}
				}
			if (str=='enp_vm_field')
				{
					xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_field_ddl=enp_ddl_field&q="+str,true);
				}
			if (str=='enp_vm_lease')
				{
					xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_lease_ddl=enp_ddl_lease&q="+str,true);
				}
			if (str=='enp_vm_comp')
				{
					xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_comp_ddl=enp_ddl_comp&q="+str,true);
				}
			if (str=='enp_vm_opratr')
				{
					xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_oprtor_ddl=enp_ddl_oprtor&q="+str,true);
				}
			xmlhttp.send();
		}
// *** end of Information Regarding Data Selection 1st DDL *** 
//
//
//
//
// *** Monthly Information Regarding Field *** 
	// *** Field Information 2nd DDL *** 
		function srpt_enp_main_prod_field_ddl(str)
			{
				_field=str;
				if (str=="")
					{
						document.getElementById("txtHint2").innerHTML="";
						return;
					}
				if (window.XMLHttpRequest)
					{
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{
						// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_field_f_ddl=mprod_field_f&q="+str,true);
				xmlhttp.send();
			}
	// *** end of Field Information 2nd DDL *** 
	// 
	// 
	// *** Field Information Period From 3rd DDL *** 
		function srpt_enp_main_prod_field_from_ddl(str)
			{
				_field_from=str;
				if (str=="")
					{
						document.getElementById("txtHint3").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_field_t_ddl=mprod_t&_field_fi="+_field+"&_field_fr="+str,true);
				xmlhttp.send();
			}
	// *** end of Field Information Period From 3rd DDL *** 
	// 
	// 
	// *** Field Information Period To 4th DDL *** 
		function srpt_enp_main_prod_field_to_ddl(str)
			{
				_field_to=str;
/*
				if (str=="")
					{
						document.getElementById("txtHint9").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_field_table=table&_field_fi="+_field+"&_field_fr="+_field_from+"&_field_to="+_field_to,true);
				xmlhttp.send();
*/
			}


		function srpt_enp_main_prod_submit_button(str)
			{
				if(str=="a")
					{
						_ag_pd=0;
					}
				if(str=="pd")
					{
						_ag_pd=1;
					}
				if (str=="")
					{
						document.getElementById("txtHint9").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_field_table=table&_field_fi="+_field+"&_field_fr="+_field_from+"&_field_to="+_field_to+"&_ag_pd="+_ag_pd,true);
				xmlhttp.send();
			}
	// *** end of Field Information Period To 4th DDL *** 
// *** end of Monthly Information Regarding Field *** 
//
//
// *** Monthly Information Regarding Lease *** 
	// *** Lease Information 2nd DDL *** 
		function srpt_enp_main_prod_lease_ddl(str)
			{
				_lease=str;
				if (str=="")
					{
						document.getElementById("txtHint2").innerHTML="";
						return;
					}
				if (window.XMLHttpRequest)
					{
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{
						// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_lease_f_ddl=mprod_lease_f&q="+str,true);
				xmlhttp.send();
			}
	// *** end of Lease Information 2nd DDL *** 
	// 
	// 
	// *** Lease Information Period From 3rd DDL *** 
		function srpt_enp_main_prod_lease_from_ddl(str)
			{
				_lease_from=str;
				if (str=="")
					{
						document.getElementById("txtHint3").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_lease_t_ddl=mprod_lease_t&_lease_fi="+_lease+"&_lease_fr="+str,true);
				xmlhttp.send();
			}
	// *** end of Lease Information Period From 3rd DDL *** 
	// 
	// 
	// *** Lease Information Period To 4th DDL *** 
		function srpt_enp_main_prod_lease_to_ddl(str)
			{
				_lease_to=str;
				if (str=="")
					{
						document.getElementById("txtHint9").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_lease_table=table&_lease_fi="+_lease+"&_lease_fr="+_lease_from+"&_lease_to="+_lease_to,true);
				xmlhttp.send();
			}
	// *** end of Lease Information Period To 4th DDL *** 
// *** end of Monthly Information Regarding Lease *** 
//
//
// *** Monthly Information Regarding Company *** 
	// *** Company Information 2nd DDL *** 
		function srpt_enp_main_prod_comp_ddl(str)
			{
				_comp=str;
				if (str=="")
					{
						document.getElementById("txtHint2").innerHTML="";
						return;
					}
				if (window.XMLHttpRequest)
					{
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{
						// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_comp_f_ddl=mprod_comp_f&q="+str,true);
				xmlhttp.send();
			}
	// *** end of Company Information 2nd DDL *** 
	// 
	// 
	// *** Company Information Period From 3rd DDL *** 
		function srpt_enp_main_prod_comp_from_ddl(str)
			{
				_comp_from=str;
				if (str=="")
					{
						document.getElementById("txtHint3").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_comp_t_ddl=mprod_t&_comp_fi="+_comp+"&_comp_fr="+str,true);
				xmlhttp.send();
			}
	// *** end of Company Information Period From 3rd DDL *** 
	// 
	// 
	// *** Company Information Period To 4th DDL *** 
		function srpt_enp_main_prod_comp_to_ddl(str)
			{
				_comp_to=str;
				if (str=="")
					{
						document.getElementById("txtHint9").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_comp_table=table&_comp_fi="+_comp+"&_comp_fr="+_comp_from+"&_comp_to="+_comp_to,true);
				xmlhttp.send();
			}
	// *** end of Company Information Period To 4th DDL *** 
// *** end of Monthly Information Regarding Company *** 
//
//
// *** Monthly Information Regarding Operator *** 
	// *** Operator Information 2nd DDL *** 
		function srpt_enp_main_prod_oprtor_ddl(str)
			{
				_comp=str;
				if (str=="")
					{
						document.getElementById("txtHint2").innerHTML="";
						return;
					}
				if (window.XMLHttpRequest)
					{
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{
						// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_oprtor_f_ddl=mprod_comp_f&q="+str,true);
				xmlhttp.send();
			}
	// *** end of Operator Information 2nd DDL *** 
	// 
	// 
	// *** Operator Information Period From 3rd DDL *** 
		function srpt_enp_main_prod_oprtor_from_ddl(str)
			{
				_comp_from=str;
				if (str=="")
					{
						document.getElementById("txtHint3").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_oprtor_t_ddl=mprod_t&_comp_fi="+_comp+"&_comp_fr="+str,true);
				xmlhttp.send();
			}
	// *** end of Operator Information Period From 3rd DDL *** 
	// 
	// 
	// *** Operator Information Period To 4th DDL *** 
		function srpt_enp_main_prod_oprtor_to_ddl(str)
			{
				_comp_to=str;
				if (str=="")
					{
						document.getElementById("txtHint9").innerHTML="";
						return;
					} 
				if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
							}
					}
				xmlhttp.open("GET","gr_enp_main_prod.php?gr_srpt_enp_main_prod_oprtor_table=table&_comp_fi="+_comp+"&_comp_fr="+_comp_from+"&_comp_to="+_comp_to,true);
				xmlhttp.send();
			}
	// *** end of Operator Information Period To 4th DDL *** 
// *** end of Monthly Information Regarding Operator *** 


