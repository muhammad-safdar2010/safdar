<?php
	require("includes/config.php");
	// *** Information Regarding Data Selection 1st DDL *** 
		function fn_enp_main_prod_dcat_ddl() 
			{
				$sql="select tb_id, tb_descr from tb_dtl where tran_info = 1 order by tb_descr";
				return fetch_query_m_prod($sql);
			}
	// *** end of Information Regarding Data Selection 1st DDL *** 
	//
	//
	// *** Monthly Information Regarding Field *** 
		// *** Field Information 2nd DDL *** 
			function fn_enp_main_prod_field_ddl()
				{
					$sql="select distinct field_id, field_descr from vu_fmaster order by field_descr";
					return fetch_query_m_prod($sql);
				}
		// *** end of Field Information 2nd DDL *** 
		// 
		// 
		// *** Field Information Period From 3rd DDL *** 
			function fn_enp_main_prod_field_f_ddl($str_field_IDf)
				{
					$sql="
						select 
							distinct 
							concat(right(ltrim(rtrim(mnid.my_descr)), 3), '-', mid(ltrim(rtrim(mnid.my_descr)), 3, 2)) prd_month, 
							mnid.mnth_id mnth_id 
						from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.field_id = $str_field_IDf 
						order by pm.prd_year, pm.prd_month";
					return fetch_query_m_prod($sql);
				}
		// *** end of Field Information Period From 3rd DDL *** 
		// 
		// 
		// *** Field Information Period To 4th DDL *** 
			function fn_enp_main_prod_field_t_ddl($str_field_IDf,$str_field_IDfr)//ZA: Added for to
				{
					$sql="
						select distinct mnid.my_descr prd_month, mnid.mnth_id mnth_id 
						from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.field_id = $str_field_IDf and pm.mnth_id >= $str_field_IDfr 
						order by pm.prd_year, pm.prd_month";
					return fetch_query_m_prod($sql);
				}
		// *** end of Field Information Period To 4th DDL *** 
		// 
		// 
		// *** Field Information Grid Details *** 
			function fn_enp_main_prod_field_table($str_field_IDf,$str_field_IDfr,$str_field_IDto,$str_freq) 
				{
					echo "_freq= ";
					echo $str_freq;
					$sql_drop_tba='';
					$sql_drop_tba="DROP TABLE IF EXISTS tb_enp_dump_mp";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tba,$dbase);
					fn_close($dbase);

					$sql_drop_tbd='';
					$sql_drop_tbd="DROP TABLE IF EXISTS tb_enp_dump_mp1";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbd,$dbase);
					fn_close($dbase);

					$sql_drop_tbdp='';
					$sql_drop_tbdp="DROP TABLE IF EXISTS tb_enp_dump_mpp";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbdp,$dbase);
					fn_close($dbase);

					$sql_create_tba='';
					$sql_create_tba="
						CREATE TABLE tb_enp_dump_mp (
							field_id decimal(6,0), field_descr varchar(50), 
							field_cont decimal(10,4), kats_code varchar(13), field_type varchar(5)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tba,$dbase);
					fn_close($dbase);

					$sql_create_tbd='';
					$sql_create_tbd="
						CREATE TABLE tb_enp_dump_mp1 (
							col1 varchar(15), col2 varchar(15), col3 varchar(15), col4 varchar(15), col5 varchar(15)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tbd,$dbase);
					fn_close($dbase);

					$sql_col_insert_tbd='';
					$sql_col_insert_tbd="
						insert into tb_enp_dump_mp1 (
							col1, col2, col3, col4, col5
						) values (
							'Field ID', 'Field Descr.', 'Company', 'Comp. Status', 'Stake %age')";
					$dbase=fn_con();
					$rs=mysql_query($sql_col_insert_tbd,$dbase);
					fn_close($dbase);

					$_mnth_id_chk='';
					$_select_header='';
					$_select_detail_in='';
					$_group_detail_out='';
					$_select_detail_out='';
					$_select_rows='';
				
					$_select_rows="
						, (SELECT count(*) column_name FROM information_schema.columns WHERE table_name='tb_enp_dump_mp1') col99";
					$_select_header="col1, col2, col3, col4, col5";
					$_select_detail_in="
						ifnull(field_id, 0) field_id, ifnull(field_descr, '') field_descr, 
						ifnull(kats_code, '') kats_code, ifnull(field_type, '') field_type, ifnull(field_cont, 0) field_cont"; 
					$_group_detail_out="tbin.field_id, tbin.field_descr, tbin.kats_code, tbin.field_type, tbin.field_cont"; 
					$_select_detail_out="tbin.field_id, tbin.field_descr, tbin.kats_code, tbin.field_type, tbin.field_cont"; 

					$sql_select='';
					$sql_select="
						select 
						vufm.field_id, vufm.field_descr, 
						vupm.mnth_id, vupm.field_cont, vupm.pr_portion, (vupm.pr_portion / 30) pr_pd_port, ifnull(vufm.kats_code, '--') kats_code, vufm.field_type 
						from vu_pmaster vupm, vu_fmaster vufm  
						where vupm.field_id = vufm.field_id and vupm.ft_sr_no = vufm.ft_sr_no and 
						vupm.field_id = $str_field_IDf and mnthid between $str_field_IDfr and $str_field_IDto 
						order by vupm.field_id, vupm.prd_year, vupm.prd_month, vufm.field_type, vupm.field_cont"; 
					$dbase=fn_con();
					$rs=mysql_query($sql_select,$dbase);
					fn_close($dbase);
					$i=5;
					while($row = mysql_fetch_array($rs))
						{
							$_field_id=$row['field_id']; 
							$_field_descr=$row['field_descr']; 
							$_mnth_id=$row['mnth_id'];
							$_field_cont=$row['field_cont'];
							$_pr_portion=$row['pr_portion'];
							$_pr_pd_port=$row['pr_pd_port'];
							$_kats_code=$row['kats_code'];
							$_field_type=$row['field_type']; 

							if ($_mnth_id_chk <> $_mnth_id) 
								{
									$i++;
									$_col = '';
									$_col = 'col'.$i;
									$_mnth_col='';
									$_mnth_id_chk='';
									$_mnth_id_chk = $_mnth_id; 
									$_pd_mnth_nam = $_mnth_id . "_pd";

									$_mnth_col=substr($_mnth_id_chk, 5, 3).'-'.substr($_mnth_id_chk, 2, 2);

									$_select_header=$_select_header . ", " . $_col ;
									$_select_detail_in=$_select_detail_in . 
										", ifnull(" . $_mnth_id_chk . ", 0) " . $_mnth_id_chk ;
									$_select_detail_out=$_select_detail_out . 
										", sum(tbin." . $_mnth_id_chk . ") " . $_mnth_id_chk;

									$sql_altera='';
									$sql_altera="
										alter table tb_enp_dump_mp add 
											column ".$_mnth_id_chk." decimal(14,4) 
										unsigned null default 0"; 
									$dbase=fn_con();
									$rs_column=mysql_query($sql_altera,$dbase);
									fn_close($dbase);

									$sql_altera_pd='';
									$sql_altera_pd="
										alter table tb_enp_dump_mp add 
											column ".$_pd_mnth_nam." decimal(14,4) 
										unsigned null default 0"; 
									$dbase=fn_con();
									$rs_column_pd=mysql_query($sql_altera_pd,$dbase);
									fn_close($dbase);

									$sql_alterd='';
									$sql_alterd="alter table tb_enp_dump_mp1 add column ".$_col." varchar(15)"; 
									$dbase=fn_con();
									$rs_column=mysql_query($sql_alterd,$dbase);
									fn_close($dbase);

									$sql_update_col_tbd="update tb_enp_dump_mp1 set ". $_col . " = " . "'" . $_mnth_col . "'";
									$dbase=fn_con();
									$rs_update_col_tbd=mysql_query($sql_update_col_tbd,$dbase);
									fn_close($dbase);
								}

							$sql_insert='';
							$sql_insert="
								insert into tb_enp_dump_mp (
									field_id, field_descr, 
									field_cont, kats_code, field_type, $_mnth_id, $_pd_mnth_nam 
								) values (
									$_field_id, '$_field_descr', 
									$_field_cont, '$_kats_code', '$_field_type', $_pr_portion, $_pr_pd_port 
								)"; 
							$dbase=fn_con();
							$results=mysql_query($sql_insert,$dbase);
							fn_close($dbase);
						}

					$sql_create_tba='';
					$sql_create_tba="create table tb_enp_dump_mpp select * from tb_enp_dump_mp";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tba,$dbase);
					fn_close($dbase);

					$sql= "select " . $_select_header . $_select_rows . 
						" from ( select " . $_select_header . " from tb_enp_dump_mp1 union all "; 
					$sql= $sql. "select " . $_select_detail_out . 
						" from ( select " . $_select_detail_in . " from tb_enp_dump_mp "; 
					$sql= $sql. ") tbin group by " . $_group_detail_out . " ) tb" ; 
					return fetch_query_m_prod($sql);
				}
			function fn_enp_main_prod_field_table_pd($_ag_pd,$_prd) 
			// function fn_enp_main_prod_field_table_pd() 
				{
				 	if($_ag_pd==0)
				 	{
				 		if ($_prd==1) {
				 			echo "Aggrigate+Oil";
							 
						 } else if ($_prd==2) {
				 			echo "Aggrigate+Gas";
							 
						 }else if ($_prd==3) {
				 			echo "Aggrigate+LPG";
							 
						 }else if ($_prd==4) {
				 			echo "Aggrigate+All";
							 
						 }
				 	}else if($_ag_pd==1)
				 	{
				 		if ($_prd==1) {
				 			echo "PerDay+Oil";
							 
						 } else if ($_prd==2) {
				 			echo "PerDay+Gas";
							 
						 }else if ($_prd==3) {
				 			echo "PerDay+LPG";
							 
						 }else if ($_prd==4) {
				 			echo "PerDay+All";
							 
						 }
				 	}
					
					$sql_drop_tba='';
					$sql_drop_tba="DROP TABLE IF EXISTS tb_enp_dump_mp";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tba,$dbase);
					fn_close($dbase);

					$sql_create_tba='';
					$sql_create_tba="create table tb_enp_dump_mp select * from tb_enp_dump_mpp";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tba,$dbase);
					fn_close($dbase);

					$_col_num=0;
					$sql_select='';
					$sql_select="
						SELECT count(*) col_name FROM information_schema.columns WHERE table_name='tb_enp_dump_mp'
						"; 
					$dbase=fn_con();
					$rs=mysql_query($sql_select,$dbase);
					fn_close($dbase);
					while($row = mysql_fetch_array($rs))
						{
							$_col_num=$row['col_name']; 
						}
					$_col_num=(($_col_num - 5) / 2); 

					$_c_num = 5; 
					$_fix_header1 = "col1, col2, col3, col4, col5"; 
					$_fix_header = "field_id, field_descr, kats_code, field_type, field_cont"; 
					$_fix_group_by = $_fix_header; 
					for($i=1; $i<=$_col_num;$i++)
						{
							$_c_num++; 
							$_col_name='';
							$_col_name='col' . $_c_num;
							$sql_select='';
							$sql_select="SELECT " . $_col_name . " FROM tb_enp_dump_mp1 limit 1"; 

							$dbase=fn_con();
							$rs=mysql_query($sql_select,$dbase);
							fn_close($dbase);
							while($row = mysql_fetch_array($rs))
								{
									if(substr($row[$_col_name], 4) > -1 and substr($row[$_col_name], 4) < 51)
										{
$_fix_header=$_fix_header . ", " . "20" . substr($row[$_col_name], 4) . "_" . substr($row[$_col_name], 0, 3); 
											$_fix_header1 = $_fix_header1 . ", col" . $_c_num; 
										}
								}
						}

					$sql = "select " . $_fix_header1;
					$sql = $sql . ", 
						(SELECT count(*) column_name FROM information_schema.columns WHERE table_name='tb_enp_dump_mp1') col99"; 
					$sql = $sql . " from ( ";  
					$sql = $sql . "select " . $_fix_header1 . " from tb_enp_dump_mp1 union all ";  
					$sql = $sql . "select " . $_fix_header . " from tb_enp_dump_mp group by " . $_fix_group_by . " ) tb "; 
					return fetch_query_m_prod($sql);
				}
		// *** end of Field Information Grid Details *** 
	// *** end of Monthly Information Regarding Field *** 
























	//
	//
	// *** Monthly Information Regarding Lease *** 
		// *** Lease Information 2nd DDL *** 
			function fn_enp_main_prod_lease_ddl()
				{
					$sql="select lease_id col1, lease_descr col2 from tb_enp_lease order by lease_descr";
					return fetch_query_m_prod($sql);
				}
		// *** end of Lease Information 2nd DDL *** 
		// 
		// 
		// *** Lease Information Period From 3rd DDL *** 
			function fn_enp_main_prod_lease_f_ddl($str_lease_IDf)
				{
					$sql="
						select distinct mnid.my_descr prd_month, mnid.mnth_id mnth_id 
						from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.field_id in 
								(select distinct fm.field_id from tb_enp_fmaster fm where fm.lease_id = $str_lease_IDf) 
						order by pm.prd_year, pm.prd_month";
					return fetch_query_m_prod($sql);
				}
		// *** end of Lease Information Period From 3rd DDL *** 
		// 
		// 
		// *** Lease Information Period To 4th DDL *** 
			function fn_enp_main_prod_lease_t_ddl($str_field_IDf,$str_field_IDfr)//ZA: Added for to
				{
					$sql="
						select tb.prd_month, tb.mnth_id 
						from ( 
							select distinct mnid.my_descr prd_month, mnid.mnth_id mnth_id, pm.prd_year, pm.prd_month prdmonth 
							from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.field_id in 
								(select distinct fm.field_id from tb_enp_fmaster fm where fm.lease_id = $str_field_IDfr) 
						     ) tb 
						where tb.mnth_id >= $str_field_IDfr 
						order by tb.prd_year, tb.prdmonth ";
					return fetch_query_m_prod($sql);
				}
		// *** end of Lease Information Period To 4th DDL *** 
		//
		//
		// *** Lease Information Grid Details *** 
			function fn_enp_main_prod_lease_table($str_lease_IDf,$str_lease_IDfr,$str_lease_IDto) 
				{
					$sql_drop_tba='';
					$sql_drop_tba="DROP TABLE IF EXISTS tb_enp_dump_mp";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tba,$dbase);
					fn_close($dbase);

					$sql_drop_tbd='';
					$sql_drop_tbd="DROP TABLE IF EXISTS tb_enp_dump_mp1";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbd,$dbase);
					fn_close($dbase);

					$sql_drop_tbc='';
					$sql_drop_tbc="DROP TABLE IF EXISTS tb_enp_dump_mp2";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbc,$dbase);
					fn_close($dbase);

					$sql_create_tba='';
					$sql_create_tba="
						CREATE TABLE tb_enp_dump_mp (
							field_id decimal(6,0), field_descr varchar(50), 
							field_cont decimal(10,4), kats_code varchar(13), field_type varchar(5)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tba,$dbase);
					fn_close($dbase);

					$sql_create_tbd='';
					$sql_create_tbd="
						CREATE TABLE tb_enp_dump_mp1 (
							col1 varchar(15), col2 varchar(15), col3 varchar(15), col4 varchar(15), col5 varchar(15)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tbd,$dbase);
					fn_close($dbase);

					$sql_create_tbc='';
					$sql_create_tbc="CREATE TABLE tb_enp_dump_mp2 (col_1 varchar(15))"; 
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tbc,$dbase);
					fn_close($dbase);

					$sql_col_insert_tbd='';
					$sql_col_insert_tbd="
						insert into tb_enp_dump_mp1 (
							col1, col2, col3, col4, col5
						) values (
							'Field ID', 'Field Descr.', 'Company', 'Comp. Status', 'Stake %age')";
					$dbase=fn_con();
					$rs=mysql_query($sql_col_insert_tbd,$dbase);
					fn_close($dbase);

					$_mnth_id_chk='';
					$_select_header='';
					$_select_detail_in='';
					$_group_detail_out='';
					$_select_detail_out='';
					$_select_rows='';

					$_col_next_count = '';

					$sql_select_field_id='';
					$sql_select_field_id="select field_id, field_descr from tb_enp_fmaster where lease_id = $str_lease_IDf"; 
					$dbase=fn_con();
					$rs_select_field_id=mysql_query($sql_select_field_id,$dbase);
					fn_close($dbase);

					while($row_field_id = mysql_fetch_array($rs_select_field_id))
						{
							$_field_id=0;
							$_field_descr='';

							$_field_id=$row_field_id[field_id]; 
							$_field_descr=$row_field_id['field_descr']; 
	
							$sql_select_field_detail='';
							$sql_select_field_detail="
								select 
									vufm.field_id, vufm.field_descr, vupm.mnth_id, vupm.field_cont, vupm.pr_portion, 
									ifnull(vufm.kats_code, '--') kats_code, vufm.field_type 
								from vu_pmaster vupm, vu_fmaster vufm  
								where 
									vupm.field_id = vufm.field_id and vupm.ft_sr_no = vufm.ft_sr_no and 
									vupm.field_id = $_field_id and mnthid between $str_lease_IDfr and $str_lease_IDto 
								order by vupm.field_id, vupm.prd_year, vupm.prd_month, vufm.field_type, vupm.field_cont"; 
							$dbase=fn_con();
							$rs_select_field_detail=mysql_query($sql_select_field_detail,$dbase);
							fn_close($dbase);

							$i=5;

							while($row_field_detail = mysql_fetch_array($rs_select_field_detail))
								{
									$_mnth_id = '';
									$_mnth_col = '';
									$_mnth_id_chk = '';
									$_pr_portion = 0;
									$_field_cont = 0;
									$_kats_code= '' ;
									$_field_type= '' ; 

									$_mnth_id = $row_field_detail['mnth_id'];
									$_pr_portion = $row_field_detail[pr_portion];
									$_field_cont = $row_field_detail[field_cont];
									$_kats_code = $row_field_detail['kats_code'];
									$_field_type = $row_field_detail['field_type']; 

									$_mnth_id_chk = $_mnth_id; 
									$_mnth_col = substr($_mnth_id,0,4).' '.substr($_mnth_id,5,3);

									$_col_1 = 0;
									$sql_update_col_tbd_select="select * from tb_enp_dump_mp2 where col_1 = " . "'$_mnth_col'"; 
									$dbase=fn_con();
									$rs_update_col_tbd_select=mysql_query($sql_update_col_tbd_select,$dbase);
									$_col_1 = mysql_num_rows($rs_update_col_tbd_select);
									fn_close($dbase);

									if($_col_1==0)
										{ 
											$i++;
											$_col = '';
											$_col = 'col'.$i;

											$_col_next_count = $_col_next_count . ", col" . $i;
										
											$_select_detail_flex_column = 
												$_select_detail_flex_column . ", ifnull(" . $_mnth_id . ", 0) " . $_mnth_id ;
											$_select_detail_sum_column = 
												$_select_detail_sum_column . ", sum(tbin." . $_mnth_id . ") " . $_mnth_id;

											$sql_update_col_tbd_insert="
												insert into tb_enp_dump_mp2 (col_1) values ('$_mnth_col')";
											$dbase=fn_con();
											$rs_update_col_tbd_insert=mysql_query($sql_update_col_tbd_insert,$dbase);
											fn_close($dbase); 

											$sql_altera='';
											$sql_altera="
												alter table tb_enp_dump_mp add 
													column ".$_mnth_id." decimal(14,4) 
												unsigned null default 0"; 
											$dbase=fn_con();
											$rs_column=mysql_query($sql_altera,$dbase);
											fn_close($dbase);

											$sql_alterd='';
											$sql_alterd="alter table tb_enp_dump_mp1 add column ". $_col ." varchar(15)"; 
											$dbase=fn_con();
											$rs_column=mysql_query($sql_alterd,$dbase);
											fn_close($dbase);

											$sql_update_col_tbd="
												update tb_enp_dump_mp1 set ". $_col . " = " . "'" . $_mnth_col . "'";
											$dbase=fn_con();
											$rs_update_col_tbd=mysql_query($sql_update_col_tbd,$dbase);
											fn_close($dbase); 
										}

									$sql_insert='';
									$sql_insert="
										insert into tb_enp_dump_mp (
											field_id, field_descr, 
											field_cont, kats_code, field_type, $_mnth_id
										) values (
											$_field_id, '$_field_descr', 
											$_field_cont, '$_kats_code', '$_field_type', $_pr_portion
										)"; 
									$dbase=fn_con();
									$results=mysql_query($sql_insert,$dbase);
									fn_close($dbase);
								}
						}

					$_select_rows="
						, (SELECT count(*) column_name FROM information_schema.columns 
						WHERE table_name='tb_enp_dump_mp1') col99"; 
					$_select_header="col3, col4, col5" . $_col_next_count;
					$_select_detail_in="
						ifnull(kats_code, '') kats_code, ifnull(field_type, '') field_type, 
						ifnull(field_cont, 0) field_cont"; 
					$_group_detail_out="
						tbin.kats_code, tbin.field_type, tbin.field_cont"; 
					$_select_detail_out="
						tbin.kats_code, tbin.field_type, tbin.field_cont"; 

					$sql = "select " . $_select_header . $_select_rows . 
						" from ( select " . $_select_header . " from tb_enp_dump_mp1 union all "; 
					$sql = $sql . "select " . $_select_detail_out . $_select_detail_sum_column . " 
						from ( select " . $_select_detail_in . $_select_detail_flex_column . " from tb_enp_dump_mp "; 
					$sql = $sql . ") tbin group by " . $_group_detail_out; 
					$sql = $sql . " ) tb order by col4, col3";

					return fetch_query_m_prod($sql);
				}
		// *** end of Lease Information Grid Details *** 
	// *** end of Monthly Information Regarding Lease *** 
	// 
	// 




















































	// *** Monthly Information Regarding Company *** 
		// *** Company Information 2nd DDL *** 
			function fn_enp_main_prod_comp_ddl()
				{
					$sql="select kats_code field_id, company_descr field_descr from tb_enp_comp order by company_descr";
					return fetch_query_m_prod($sql);
				}
		// *** end of Company Information 2nd DDL *** 
		// 
		// 
		// *** Company Information Period From 3rd DDL *** 
			function fn_enp_main_prod_comp_f_ddl($str_comp_IDf)
				{
					$sql="
 						select 
							distinct 
							concat(right(ltrim(rtrim(mnid.my_descr)), 3), '-', mid(ltrim(rtrim(mnid.my_descr)), 3, 2)) prd_month, 
							mnid.mnth_id mnth_id 
						from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft, tb_enp_comp co 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.co_sr_no = co.co_sr_no and 
 							co.kats_code = '$str_comp_IDf' 
						order by pm.prd_year, pm.prd_month";
					return fetch_query_m_prod($sql);
				}
		// *** end of Company Information Period From 3rd DDL *** 
		// 
		// 
		// *** Company Information Period To 4th DDL *** 
			function fn_enp_main_prod_comp_t_ddl($str_comp_IDf,$str_comp_IDfr)//ZA: Added for to
				{
					$sql="
						select 
							distinct 
							concat(right(ltrim(rtrim(mnid.my_descr)), 3), '-', mid(ltrim(rtrim(mnid.my_descr)), 3, 2)) prd_month, 
							mnid.mnth_id mnth_id 
						from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft, tb_enp_comp co 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.co_sr_no = co.co_sr_no and 
							co.kats_code = '$str_comp_IDf' and pm.mnth_id >= $str_comp_IDfr 
						order by pm.prd_year, pm.prd_month";
					return fetch_query_m_prod($sql);
				}
		// *** end of Company Information Period To 4th DDL *** 
		//
		// *** Company Information Grid Details *** 
			function fn_enp_main_prod_comp_table($str_comp_IDf,$str_comp_IDfr,$str_comp_IDto) 
				{
					$sql_drop_tba='';
					$sql_drop_tba="DROP TABLE IF EXISTS tb_enp_dump_mp";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tba,$dbase);
					fn_close($dbase);

					$sql_drop_tbd='';
					$sql_drop_tbd="DROP TABLE IF EXISTS tb_enp_dump_mp1";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbd,$dbase);
					fn_close($dbase);

					$sql_drop_tbc='';
					$sql_drop_tbc="DROP TABLE IF EXISTS tb_enp_dump_mp2";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbc,$dbase);
					fn_close($dbase);

					$sql_create_tba='';
					$sql_create_tba="
						CREATE TABLE tb_enp_dump_mp (
							field_id decimal(6,0), field_descr varchar(50), 
							field_cont decimal(10,4), kats_code varchar(13), field_type varchar(5)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tba,$dbase);
					fn_close($dbase);

					$sql_create_tbd='';
					$sql_create_tbd="
						CREATE TABLE tb_enp_dump_mp1 (
							col1 varchar(15), col2 varchar(15), col3 varchar(15), col4 varchar(15), col5 varchar(15)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tbd,$dbase);
					fn_close($dbase);

					$sql_create_tbc='';
					$sql_create_tbc="CREATE TABLE tb_enp_dump_mp2 (col_1 varchar(15))"; 
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tbc,$dbase);
					fn_close($dbase);

					$sql_col_insert_tbd='';
					$sql_col_insert_tbd="
						insert into tb_enp_dump_mp1 (
							col1, col2, col3, col4, col5
						) values (
							'Field ID', 'Field Descr.', 'Company', 'Comp. Status', 'Stake %age')";
					$dbase=fn_con();
					$rs=mysql_query($sql_col_insert_tbd,$dbase);
					fn_close($dbase);

					$_mnth_id_chk='';
					$_select_header='';
					$_select_detail_in='';
					$_group_detail_out='';
					$_select_detail_out='';
					$_select_rows='';

					$_col_next_count = '';

					$sql_select_field_id='';
					$sql_select_field_id="
						select 
							distinct fm.field_id, fm.field_descr 
						from tb_enp_fmaster fm, tb_enp_ftran ft 
						where 
							fm.field_id = ft.field_id and 
							ft.co_sr_no in (select co.co_sr_no from tb_enp_comp co where co.kats_code = '$str_comp_IDf') 
						order by fm.field_id"; 
					$dbase=fn_con();
					$rs_select_field_id=mysql_query($sql_select_field_id,$dbase);
					fn_close($dbase);

					while($row_field_id = mysql_fetch_array($rs_select_field_id))
						{
							$_field_id=0;
							$_field_descr='';

							$_field_id=$row_field_id[field_id]; 
							$_field_descr=$row_field_id['field_descr']; 
	
							$sql_select_field_detail='';
							$sql_select_field_detail="
								select 
									vufm.field_id, vufm.field_descr, vupm.mnth_id, vupm.field_cont, vupm.pr_portion, 
									ifnull(vufm.kats_code, '--') kats_code, vufm.field_type 
								from vu_pmaster vupm, vu_fmaster vufm  
								where 
									vupm.field_id = vufm.field_id and vupm.ft_sr_no = vufm.ft_sr_no and 
									vupm.field_id = $_field_id and vufm.kats_code = '$str_comp_IDf' and 
									mnthid between $str_comp_IDfr and $str_comp_IDto 
								order by vupm.field_id, vupm.prd_year, vupm.prd_month, vufm.field_type, vupm.field_cont"; 
							$dbase=fn_con();
							$rs_select_field_detail=mysql_query($sql_select_field_detail,$dbase);
							fn_close($dbase);

							$i=5;

							while($row_field_detail = mysql_fetch_array($rs_select_field_detail))
								{
									$_mnth_id = '';
									$_mnth_col = '';
									$_mnth_id_chk = '';
									$_pr_portion = 0;
									$_field_cont = 0;
									$_kats_code= '' ;
									$_field_type= '' ; 

									$_mnth_id = $row_field_detail['mnth_id'];
									$_pr_portion = $row_field_detail[pr_portion];
									$_field_cont = $row_field_detail[field_cont];
									$_kats_code = $row_field_detail['kats_code'];
									$_field_type = $row_field_detail['field_type']; 

									$_mnth_id_chk = $_mnth_id; 
									$_mnth_col = substr($_mnth_id,0,4).' '.substr($_mnth_id,5,3);

									$_col_1 = 0;
									$sql_update_col_tbd_select="select * from tb_enp_dump_mp2 where col_1 = " . "'$_mnth_col'"; 
									$dbase=fn_con();
									$rs_update_col_tbd_select=mysql_query($sql_update_col_tbd_select,$dbase);
									$_col_1 = mysql_num_rows($rs_update_col_tbd_select);
									fn_close($dbase);

									if($_col_1==0)
										{ 
											$i++;
											$_col = '';
											$_col = 'col'.$i;

											$_col_next_count = $_col_next_count . ", col" . $i;
										
											$_select_detail_flex_column = 
												$_select_detail_flex_column . ", ifnull(" . $_mnth_id . ", 0) " . $_mnth_id ;
											$_select_detail_sum_column = 
												$_select_detail_sum_column . ", sum(tbin." . $_mnth_id . ") " . $_mnth_id;

											$sql_update_col_tbd_insert="
												insert into tb_enp_dump_mp2 (col_1) values ('$_mnth_col')";
											$dbase=fn_con();
											$rs_update_col_tbd_insert=mysql_query($sql_update_col_tbd_insert,$dbase);
											fn_close($dbase); 

											$sql_altera='';
											$sql_altera="
												alter table tb_enp_dump_mp add 
													column ".$_mnth_id." decimal(14,4) 
												unsigned null default 0"; 
											$dbase=fn_con();
											$rs_column=mysql_query($sql_altera,$dbase);
											fn_close($dbase);

											$sql_alterd='';
											$sql_alterd="alter table tb_enp_dump_mp1 add column ". $_col ." varchar(15)"; 
											$dbase=fn_con();
											$rs_column=mysql_query($sql_alterd,$dbase);
											fn_close($dbase);

											$sql_update_col_tbd="
												update tb_enp_dump_mp1 set ". $_col . " = " . "'" . $_mnth_col . "'";
											$dbase=fn_con();
											$rs_update_col_tbd=mysql_query($sql_update_col_tbd,$dbase);
											fn_close($dbase); 
										}

									$sql_insert='';
									$sql_insert="
										insert into tb_enp_dump_mp (
											field_id, field_descr, 
											field_cont, kats_code, field_type, $_mnth_id
										) values (
											$_field_id, '$_field_descr', 
											$_field_cont, '$_kats_code', '$_field_type', $_pr_portion
										)"; 
									$dbase=fn_con();
									$results=mysql_query($sql_insert,$dbase);
									fn_close($dbase);
								}
						}

					$_select_rows="
						, (SELECT count(*) column_name FROM information_schema.columns 
						WHERE table_name='tb_enp_dump_mp1') col99"; 
					$_select_header="col1, col2, col3, col4, col5" . $_col_next_count;
					$_select_detail_in="
						ifnull(field_id, 0) field_id, ifnull(field_descr, '') field_descr, 
						ifnull(kats_code, '') kats_code, ifnull(field_type, '') field_type, 
						ifnull(field_cont, 0) field_cont"; 
					$_group_detail_out="
						tbin.field_id, tbin.field_descr, tbin.kats_code, tbin.field_type, tbin.field_cont"; 
					$_select_detail_out="
						tbin.field_id, tbin.field_descr, tbin.kats_code, tbin.field_type, tbin.field_cont"; 

					$sql= "select " . $_select_header . $_select_rows . 
						" from ( select " . $_select_header . " from tb_enp_dump_mp1 union all "; 
					$sql= $sql. "select " . $_select_detail_out . $_select_detail_sum_column . " 
						from ( select " . $_select_detail_in . $_select_detail_flex_column . " from tb_enp_dump_mp "; 
					$sql= $sql. ") tbin group by " . $_group_detail_out . " ) tb order by col4, col2" ; 
					return fetch_query_m_prod($sql);
				}
		// *** end of Company Information Grid Details *** 
	// *** end of Monthly Information Regarding Company *** 





























	// 
	// 
	// *** Monthly Information Regarding Operator *** 
		// *** Operator Information 2nd DDL *** 
			function fn_enp_main_prod_oprtor_ddl()
				{
					$sql="select kats_code field_id, company_descr field_descr from tb_enp_comp order by company_descr";
					return fetch_query_m_prod($sql);
				}
		// *** end of Operator Information 2nd DDL *** 
		// 
		// 
		// *** Operator Information Period From 3rd DDL *** 
			function fn_enp_main_prod_oprtor_f_ddl($str_comp_IDf)
				{
					$sql="
 						select distinct mnid.my_descr prd_month, mnid.mnth_id mnth_id 
						from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft, tb_enp_comp co 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.co_sr_no = co.co_sr_no and 
 							co.kats_code = '$str_comp_IDf' 
						order by pm.prd_year, pm.prd_month";
					return fetch_query_m_prod($sql);
				}
		// *** end of Operator Information Period From 3rd DDL *** 
		// 
		// 
		// *** Operator Information Period To 4th DDL *** 
			function fn_enp_main_prod_oprtor_t_ddl($str_comp_IDf,$str_comp_IDfr)//ZA: Added for to
				{
					$sql="
						select distinct mnid.my_descr prd_month, mnid.mnth_id mnth_id 
						from tb_enp_p_myid mnid, tb_enp_pmaster pm, tb_enp_ptran pt, tb_enp_ftran ft, tb_enp_comp co 
						where 
							mnid.mnth_id = pm.mnth_id and 
							pm.prd_id = pt.prd_id and 
							pt.ft_sr_no = ft.ft_sr_no and 
							ft.co_sr_no = co.co_sr_no and 
							co.kats_code = '$str_comp_IDf' and pm.mnth_id >= $str_comp_IDfr 
						order by pm.prd_year, pm.prd_month";
					return fetch_query_m_prod($sql);
				}
		// *** end of Operator Information Period To 4th DDL *** 
		//
		// *** Operator Information Grid Details *** 
			function fn_enp_main_prod_oprtor_table($str_comp_IDf,$str_comp_IDfr,$str_comp_IDto) 
				{
					$sql_drop_tba='';
					$sql_drop_tba="DROP TABLE IF EXISTS tb_enp_dump_mp";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tba,$dbase);
					fn_close($dbase);

					$sql_drop_tbd='';
					$sql_drop_tbd="DROP TABLE IF EXISTS tb_enp_dump_mp1";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbd,$dbase);
					fn_close($dbase);

					$sql_drop_tbc='';
					$sql_drop_tbc="DROP TABLE IF EXISTS tb_enp_dump_mp2";
					$dbase=fn_con();
					$rs=mysql_query($sql_drop_tbc,$dbase);
					fn_close($dbase);

					$sql_create_tba='';
					$sql_create_tba="
						CREATE TABLE tb_enp_dump_mp (
							field_id decimal(6,0), field_descr varchar(50), 
							field_cont decimal(10,4), kats_code varchar(13), field_type varchar(5)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tba,$dbase);
					fn_close($dbase);

					$sql_create_tbd='';
					$sql_create_tbd="
						CREATE TABLE tb_enp_dump_mp1 (
							col1 varchar(15), col2 varchar(15), col3 varchar(15), col4 varchar(15), col5 varchar(15)
						)";
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tbd,$dbase);
					fn_close($dbase);

					$sql_create_tbc='';
					$sql_create_tbc="CREATE TABLE tb_enp_dump_mp2 (col_1 varchar(15))"; 
					$dbase=fn_con();
					$rs=mysql_query($sql_create_tbc,$dbase);
					fn_close($dbase);

					$sql_col_insert_tbd='';
					$sql_col_insert_tbd="
						insert into tb_enp_dump_mp1 (
							col1, col2, col3, col4, col5
						) values (
							'Field ID', 'Field Descr.', 'Company', 'Comp. Status', 'Stake %age')";
					$dbase=fn_con();
					$rs=mysql_query($sql_col_insert_tbd,$dbase);
					fn_close($dbase);

					$_mnth_id_chk='';
					$_select_header='';
					$_select_detail_in='';
					$_group_detail_out='';
					$_select_detail_out='';
					$_select_rows='';

					$_col_next_count = '';

					$sql_select_field_id='';
					$sql_select_field_id="
						select 
							distinct fm.field_id, fm.field_descr 
						from tb_enp_fmaster fm, tb_enp_ftran ft 
						where 
							fm.field_id = ft.field_id and 
							ft.co_sr_no in (select co.co_sr_no from tb_enp_comp co where co.kats_code = '$str_comp_IDf') 
						order by fm.field_id"; 
					$dbase=fn_con();
					$rs_select_field_id=mysql_query($sql_select_field_id,$dbase);
					fn_close($dbase);

					while($row_field_id = mysql_fetch_array($rs_select_field_id))
						{
							$_field_id=0;
							$_field_descr='';

							$_field_id=$row_field_id[field_id]; 
							$_field_descr=$row_field_id['field_descr']; 
	
							$sql_select_field_detail='';
							$sql_select_field_detail="
								select 
									vufm.field_id, vufm.field_descr, vupm.mnth_id, vupm.field_cont, vupm.pr_portion, 
									ifnull(vufm.kats_code, '--') kats_code, vufm.field_type 
								from vu_pmaster vupm, vu_fmaster vufm  
								where 
									vupm.field_id = vufm.field_id and vupm.ft_sr_no = vufm.ft_sr_no and 
									vupm.field_id = $_field_id and vufm.kats_code = '$str_comp_IDf' and 
									mnthid between $str_comp_IDfr and $str_comp_IDto 
								order by vupm.field_id, vupm.prd_year, vupm.prd_month, vufm.field_type, vupm.field_cont"; 
							$dbase=fn_con();
							$rs_select_field_detail=mysql_query($sql_select_field_detail,$dbase);
							fn_close($dbase);

							$i=5;

							while($row_field_detail = mysql_fetch_array($rs_select_field_detail))
								{
									$_mnth_id = '';
									$_mnth_col = '';
									$_mnth_id_chk = '';
									$_pr_portion = 0;
									$_field_cont = 0;
									$_kats_code= '' ;
									$_field_type= '' ; 

									$_mnth_id = $row_field_detail['mnth_id'];
									$_pr_portion = $row_field_detail[pr_portion];
									$_field_cont = $row_field_detail[field_cont];
									$_kats_code = $row_field_detail['kats_code'];
									$_field_type = $row_field_detail['field_type']; 

									$_mnth_id_chk = $_mnth_id; 
									$_mnth_col = substr($_mnth_id,0,4).' '.substr($_mnth_id,5,3);

									$_col_1 = 0;
									$sql_update_col_tbd_select="select * from tb_enp_dump_mp2 where col_1 = " . "'$_mnth_col'"; 
									$dbase=fn_con();
									$rs_update_col_tbd_select=mysql_query($sql_update_col_tbd_select,$dbase);
									$_col_1 = mysql_num_rows($rs_update_col_tbd_select);
									fn_close($dbase);

									if($_col_1==0)
										{ 
											$i++;
											$_col = '';
											$_col = 'col'.$i;

											$_col_next_count = $_col_next_count . ", col" . $i;
										
											$_select_detail_flex_column = 
												$_select_detail_flex_column . ", ifnull(" . $_mnth_id . ", 0) " . $_mnth_id ;
											$_select_detail_sum_column = 
												$_select_detail_sum_column . ", sum(tbin." . $_mnth_id . ") " . $_mnth_id;

											$sql_update_col_tbd_insert="
												insert into tb_enp_dump_mp2 (col_1) values ('$_mnth_col')";
											$dbase=fn_con();
											$rs_update_col_tbd_insert=mysql_query($sql_update_col_tbd_insert,$dbase);
											fn_close($dbase); 

											$sql_altera='';
											$sql_altera="
												alter table tb_enp_dump_mp add 
													column ".$_mnth_id." decimal(14,4) 
												unsigned null default 0"; 
											$dbase=fn_con();
											$rs_column=mysql_query($sql_altera,$dbase);
											fn_close($dbase);

											$sql_alterd='';
											$sql_alterd="alter table tb_enp_dump_mp1 add column ". $_col ." varchar(15)"; 
											$dbase=fn_con();
											$rs_column=mysql_query($sql_alterd,$dbase);
											fn_close($dbase);

											$sql_update_col_tbd="
												update tb_enp_dump_mp1 set ". $_col . " = " . "'" . $_mnth_col . "'";
											$dbase=fn_con();
											$rs_update_col_tbd=mysql_query($sql_update_col_tbd,$dbase);
											fn_close($dbase); 
										}

									$sql_insert='';
									$sql_insert="
										insert into tb_enp_dump_mp (
											field_id, field_descr, 
											field_cont, kats_code, field_type, $_mnth_id
										) values (
											$_field_id, '$_field_descr', 
											$_field_cont, '$_kats_code', '$_field_type', $_pr_portion
										)"; 
									$dbase=fn_con();
									$results=mysql_query($sql_insert,$dbase);
									fn_close($dbase);
								}
						}

					$_select_rows="
						, (SELECT count(*) column_name FROM information_schema.columns 
						WHERE table_name='tb_enp_dump_mp1') col99"; 
					$_select_header="col1, col2, col3, col4, col5" . $_col_next_count;
					$_select_detail_in="
						ifnull(field_id, 0) field_id, ifnull(field_descr, '') field_descr, 
						ifnull(kats_code, '') kats_code, ifnull(field_type, '') field_type, 
						ifnull(field_cont, 0) field_cont"; 
					$_group_detail_out="
						tbin.field_id, tbin.field_descr, tbin.kats_code, tbin.field_type, tbin.field_cont"; 
					$_select_detail_out="
						tbin.field_id, tbin.field_descr, tbin.kats_code, tbin.field_type, tbin.field_cont"; 

					$sql= "select " . $_select_header . $_select_rows . 
						" from ( select " . $_select_header . " from tb_enp_dump_mp1 union all "; 
					$sql= $sql. "select " . $_select_detail_out . $_select_detail_sum_column . " 
						from ( select " . $_select_detail_in . $_select_detail_flex_column . " from tb_enp_dump_mp "; 
					$sql= $sql. ") tbin group by " . $_group_detail_out . " ) tb 
						where col4 in ('Comp. Status', 'Opr') order by col4, col2" ; 
					return fetch_query_m_prod($sql);
				}
		// *** end of Operator Information Grid Details *** 
	// *** end of Monthly Information Regarding Operator *** 







	function fetch_query_m_prod($sql)
		{
			$dbase = fn_con();
			$rs = mysql_query($sql,$dbase);
			fn_close($dbase);
			while($row=mysql_fetch_assoc($rs))
			{
				$data[]=$row;
			}
			return $data;
		}



?>
