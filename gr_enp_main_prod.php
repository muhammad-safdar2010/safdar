<link rel="stylesheet" href="css/style.css">
<?php
	//include("includes/config.php");
	include("includes/fn_enp_main_prod.php");
//	$bgcolorh='#BCBCBC';
	$bgcolorh='#666666';
//	$bgcolor1='#F0F0F0';  
	$bgcolor1='#FDF784';
//	$bgcolor2='#F9F9F9';
	$bgcolor2='#C0C0C0';
	$fcolor1='#990000';
	$fcolor2='#0000FF';
	$fcolor=$fcolor1;
	$_field;
	$_field_from;
	$_field_to;
	$_lease;
	$_lease_from;
	$_lease_to;
?>
<!-- *** Monthly Information Regarding Field *** -->
	<!-- *** Field Information 2nd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_field_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_field_ddl']=='enp_ddl_field')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_field_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$menu=fn_enp_main_prod_field_ddl();
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['field_id']?>">
													<?php echo $menu[$i]['field_descr']?>
										</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Field Information 2nd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Field Information Period From 3rd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_field_f_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_field_f_ddl']=='mprod_field_f')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_field_from_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_field_IDf=$_REQUEST['q'];
								$menu=fn_enp_main_prod_field_f_ddl($str_field_IDf);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
										</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Field Information Period From 3rd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Field Information Period To 4th DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_field_t_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_field_t_ddl']=='mprod_t')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_field_to_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_field_IDf=$_REQUEST['_field_fi'];
								$str_field_IDfr=$_REQUEST['_field_fr'];
								$menu=fn_enp_main_prod_field_t_ddl($str_field_IDf,$str_field_IDfr);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
											</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Field Information Period To 4th DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Field Information Grid Details *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_field_table'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_field_table']=='table')
						{ 
							$_col='';
							$_header=0;
							$str_field_IDf=$_REQUEST['_field_fi'];
							$str_field_IDfr=$_REQUEST['_field_fr'];
							$str_field_IDto=$_REQUEST['_field_to'];
							$menu=fn_enp_main_prod_field_table($str_field_IDf,$str_field_IDfr,$str_field_IDto);
							$i=0;
							echo "
								<table style='border:1px solid black;border-collapse:collapse;' class='general_lbl'><thead>
								";
									while($i<sizeof($menu))
										{
											if($_header==0) 
												{
													echo "<tr bgcolor='" . $bgcolorh . "' style=\"font-weight:bold\">";
														for ($x=3; $x<=$menu[$i]['col99']; $x++)
															{
																$_col='col' . $x;
																echo "<th 
																	style=\"border:1px solid black;
																	\"width=\"200\" \" height=\"32\" 
																	>
																		<font 
																			color=\"#FFFFFF\" style=\"font-weight:bold\">" 
																				.$menu[$i][$_col]. 
																		"</font>
																	</th>";
															}
													echo "</tr></thead>";
												} 
											if($_header==1) 
												{
													if ($i&1)
														{
															echo "<tr bgcolor='" . $bgcolor1 . "'>";
															for ($x=3; $x<=$menu[$i]['col99']; $x++)
																{
																	$_col='col' . $x;
																	If($menu[$i]['col4']=='Opr')
																		{
																			$fcolor=$fcolor1;
																		}
																	else
																		{
//																			$fcolor=$fcolor2;
																			$fcolor='#000000';
																		}
																			If($x<5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>" 
																					.$menu[$i][$_col]. 
																			"</font></th>";
																				}
																			If($x==5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>" 
																					. number_format($menu[$i][$_col],2) . 
																			"%</font></th>";
																				}
																			If($x>5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>" 
																					. number_format($menu[$i][$_col],2) . 
																			"</font></th>";
																				}
																}
															echo "</tr>";
														}
													else
														{
															echo "<tr bgcolor='" . $bgcolor2 . "'>";
															for ($x=3; $x<=$menu[$i]['col99']; $x++)
																{
																	$_col='col' . $x;
																	If($menu[$i]['col4']=='Opr')
																		{
																			$fcolor=$fcolor1;
																		}
																	else
																		{
//																			$fcolor=$fcolor2;
																			$fcolor='#000000';
																		}
																			If($x<5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>"  
																						. $menu[$i][$_col] . 
																		"</font></th>";
																				}
																			If($x==5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>"  
																					. number_format($menu[$i][$_col],2) . 
																		"% </font></th>";
																				}
																			If($x>5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>"  
																					. number_format($menu[$i][$_col],2) . 
																		"</font></th>";
																				}
																}
															echo "</tr>";
														}
												} 
											$_header=1;
											$i++;
										}
							echo "</table>";
						}
				}
		?>
	<!-- *** end of Field Information Grid Details *** -->
<!-- *** end of Monthly Information Regarding Field *** -->
<!-- -->
<!-- -->
<!-- *** Monthly Information Regarding Lease *** -->
	<!-- *** Lease Information 2nd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_lease_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_lease_ddl']=='enp_ddl_lease')
						{
		?>
							<select 
    	                    	name="myddl_enp_mview_lease" 
        	                    style="width:100%";
								 onchange="srpt_enp_main_prod_lease_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$menu=fn_enp_main_prod_lease_ddl();
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option value="<?php echo $menu[$i]['col1']?>"><?php echo $menu[$i]['col2']?></option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Lease Information 2nd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Lease Information Period From 3rd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_lease_f_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_lease_f_ddl']=='mprod_lease_f')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_lease_from_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_lease_IDf=$_REQUEST['q'];
								$menu=fn_enp_main_prod_lease_f_ddl($str_lease_IDf);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
										</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Lease Information Period From 3rd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Lease Information Period To 4th DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_lease_t_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_lease_t_ddl']=='mprod_lease_t')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_lease_to_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_lease_IDf=$_REQUEST['_lease_fi'];
								$str_lease_IDfr=$_REQUEST['_lease_fr'];
								$menu=fn_enp_main_prod_lease_t_ddl($str_lease_IDf,$str_lease_IDfr);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
											</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Lease Information Period To 4th DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Lease Information Grid Details *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_lease_table'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_lease_table']=='table')
						{ 
							$_col='';
							$_header=0;
							$str_lease_IDf=$_REQUEST['_lease_fi'];
							$str_lease_IDfr=$_REQUEST['_lease_fr'];
							$str_lease_IDto=$_REQUEST['_lease_to'];
							$menu=fn_enp_main_prod_lease_table($str_lease_IDf,$str_lease_IDfr,$str_lease_IDto);
							$i=0;
							echo "
								<table style='border:1px solid black;border-collapse:collapse;' class='general_lbl'><thead>
								";
									while($i<sizeof($menu))
										{
											if($_header==0) 
												{
													echo "<tr bgcolor='" . $bgcolorh . "' style=\"font-weight:bold\">";
														for ($x=3; $x<=$menu[$i]['col99']; $x++)
															{
																$_col='col' . $x;
																echo "<th 
																	style=\"border:1px solid black;
																	\"width=\"200\" \" height=\"32\" 
																	>
																		<font 
																			color=\"#FFFFFF\" style=\"font-weight:bold\">" 
																				.$menu[$i][$_col]. 
																		"</font>
																	</th>";
															}
													echo "</tr></thead>";
												} 
											if($_header==1) 
												{
													if ($i&1)
														{
															echo "<tr bgcolor='" . $bgcolor1 . "'>";
															for ($x=3; $x<=$menu[$i]['col99']; $x++)
																{
																	$_col='col' . $x;
																	If($menu[$i]['col4']=='Opr')
																		{
																			$fcolor=$fcolor1;
																		}
																	else
																		{
//																			$fcolor=$fcolor2;
																			$fcolor='#000000';
																		}
																			If($x<5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>" 
																					.$menu[$i][$_col]. 
																			"</font></th>";
																				}
																			If($x==5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>" 
																					. number_format($menu[$i][$_col],2) . 
																			"%</font></th>";
																				}
																			If($x>5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>" 
																					. number_format($menu[$i][$_col],2) . 
																			"</font></th>";
																				}
																}
															echo "</tr>";
														}
													else
														{
															echo "<tr bgcolor='" . $bgcolor2 . "'>";
															for ($x=3; $x<=$menu[$i]['col99']; $x++)
																{
																	$_col='col' . $x;
																	If($menu[$i]['col4']=='Opr')
																		{
																			$fcolor=$fcolor1;
																		}
																	else
																		{
//																			$fcolor=$fcolor2;
																			$fcolor='#000000';
																		}
																			If($x<5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>"  
																						. $menu[$i][$_col] . 
																		"</font></th>";
																				}
																			If($x==5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>"  
																					. number_format($menu[$i][$_col],2) . 
																		"% </font></th>";
																				}
																			If($x>5)
																				{
																	echo "<th 
																		style=\"border:1px solid black;
																		\"width=\"200\" \" height=\"32\" 
																		>
																			<font 
																				color='" . $fcolor . "'>"  
																					. number_format($menu[$i][$_col],2) . 
																		"</font></th>";
																				}
																}
															echo "</tr>";
														}
												} 
											$_header=1;
											$i++;
										}
							echo "</table>";
						}
				}
		?>
	<!-- *** end of Lease Information Grid Details *** -->
<!-- *** end of Monthly Information Regarding Lease *** -->
<!-- -->
<!-- -->































<!-- *** Monthly Information Regarding Company *** -->
	<!-- *** Company Information 2nd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_comp_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_comp_ddl']=='enp_ddl_comp')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_comp_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$menu=fn_enp_main_prod_comp_ddl();
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['field_id']?>">
													<?php echo $menu[$i]['field_descr']?>
										</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Company Information 2nd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Company Information Period From 3rd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_comp_f_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_comp_f_ddl']=='mprod_comp_f')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_comp_from_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_comp_IDf=$_REQUEST['q'];
								$menu=fn_enp_main_prod_comp_f_ddl($str_comp_IDf);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
										</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Company Information Period From 3rd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Company Information Period To 4th DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_comp_t_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_comp_t_ddl']=='mprod_t')
						{
		?>
							<select 
									name="myddl_enp_mview_comp" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_comp_to_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_comp_IDf=$_REQUEST['_comp_fi'];
								$str_comp_IDfr=$_REQUEST['_comp_fr'];
								$menu=fn_enp_main_prod_comp_t_ddl($str_comp_IDf,$str_comp_IDfr);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
											</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Company Information Period To 4th DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Company Information Grid Details *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_comp_table'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_comp_table']=='table')
						{ 
							$_col='';
							$_header=0;
							$str_comp_IDf=$_REQUEST['_comp_fi'];
							$str_comp_IDfr=$_REQUEST['_comp_fr'];
							$str_comp_IDto=$_REQUEST['_comp_to'];
							$menu=fn_enp_main_prod_comp_table($str_comp_IDf,$str_comp_IDfr,$str_comp_IDto);
							$i=0;
							echo "
								<table style='border:1px solid black;border-collapse:collapse;' class='general_lbl'><thead>
								";
									while($i<sizeof($menu))
										{
											if($_header==0) 
												{
													echo "<tr bgcolor='" . $bgcolorh . "' style=\"font-weight:bold\">";
														for ($x=1; $x<=$menu[$i]['col99']; $x++)
															{
																if($x!=3)
																	{
																		$_col='col' . $x;
																		echo "<th 
																			style=\"border:1px solid black;
																			\"width=\"200\" \" height=\"32\" 
																			>
																				<font 
																					color=\"#FFFFFF\" style=\"font-weight:bold\">"
																					.$menu[$i][$_col].
																				"</font>
																			</th>";
																	}
															}
													echo "</tr></thead>";
												} 
											if($_header==1) 
												{
													if ($i&1)
														{
															echo "<tr bgcolor='" . $bgcolor1 . "'>";
															for ($x=1; $x<=$menu[$i]['col99']; $x++)
																{
																	if($x!=3)
																		{
																			$_col='col' . $x;
																			If($menu[$i]['col4']=='Opr')
																				{
																					$fcolor=$fcolor1;
																				}
																			else
																				{
//																					$fcolor=$fcolor2;
																					$fcolor='#000000';
																				}
																					If($x<5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>" 
																							.$menu[$i][$_col]. 
																					"</font></th>";
																						}
																					If($x==5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>" 
																							. number_format($menu[$i][$_col],2) . 
																					"%</font></th>";
																						}
																					If($x>5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>" 
																							. number_format($menu[$i][$_col],2) . 
																					"</font></th>";
																						}
																		}
																}
															echo "</tr>";
														}
													else
														{
															echo "<tr bgcolor='" . $bgcolor2 . "'>";
															for ($x=1; $x<=$menu[$i]['col99']; $x++)
																{
																	if($x!=3)
																		{
																			$_col='col' . $x;
																			If($menu[$i]['col4']=='Opr')
																				{
																					$fcolor=$fcolor1;
																				}
																			else
																				{
//																					$fcolor=$fcolor2;
																					$fcolor='#000000';
																				}
																					If($x<5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>"  
																								. $menu[$i][$_col] . 
																				"</font></th>";
																						}
																					If($x==5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>"  
																							. number_format($menu[$i][$_col],2) . 
																				"% </font></th>";
																						}
																					If($x>5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>"  
																							. number_format($menu[$i][$_col],2) . 
																				"</font></th>";
																						}
																		}
																}
															echo "</tr>";
														}
												} 
											$_header=1;
											$i++;
										}
							echo "</table>";
						}
				}
		?>
	<!-- *** end of Company Information Grid Details *** -->
<!-- *** end of Monthly Information Regarding Company *** -->























<!-- -->
<!-- -->
<!-- *** Monthly Information Regarding Operator *** -->
	<!-- *** Operator Information 2nd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_oprtor_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_oprtor_ddl']=='enp_ddl_oprtor')
						{
		?>
							<select 
									name="myddl_enp_mview_oprtor" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_oprtor_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$menu=fn_enp_main_prod_oprtor_ddl();
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['field_id']?>">
													<?php echo $menu[$i]['field_descr']?>
										</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Operator Information 2nd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Operator Information Period From 3rd DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_oprtor_f_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_oprtor_f_ddl']=='mprod_comp_f')
						{
		?>
							<select 
									name="myddl_enp_mview_oprtor" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_oprtor_from_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_comp_IDf=$_REQUEST['q'];
								$menu=fn_enp_main_prod_oprtor_f_ddl($str_comp_IDf);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
										</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Operator Information Period From 3rd DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Operator Information Period To 4th DDL *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_oprtor_t_ddl'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_oprtor_t_ddl']=='mprod_t')
						{
		?>
							<select 
									name="myddl_enp_mview_oprtor" 
									style="width:100%"; 
									onChange="srpt_enp_main_prod_oprtor_to_ddl(this.value)">
								<option value="0">
									-- Select -- 
								</option>
		<?php
								$str_comp_IDf=$_REQUEST['_comp_fi'];
								$str_comp_IDfr=$_REQUEST['_comp_fr'];
								$menu=fn_enp_main_prod_oprtor_t_ddl($str_comp_IDf,$str_comp_IDfr);
								$i=0;
								while($i<sizeof($menu))
									{
		?>
										<option 
											value="	<?php echo $menu[$i]['mnth_id']?>">
													<?php echo $menu[$i]['prd_month']?>
											</option>
		<?php
										$i++;
									}
		?>
							</select>
		<?php
						}
				}
		?>
	<!-- *** end of Operator Information Period To 4th DDL *** -->
	<!-- -->
	<!-- -->
	<!-- *** Operator Information Grid Details *** -->
		<?php
			if(isset($_REQUEST['gr_srpt_enp_main_prod_oprtor_table'])) 
				{
					if($_REQUEST['gr_srpt_enp_main_prod_oprtor_table']=='table')
						{ 
							$_col='';
							$_header=0;
							$str_comp_IDf=$_REQUEST['_comp_fi'];
							$str_comp_IDfr=$_REQUEST['_comp_fr'];
							$str_comp_IDto=$_REQUEST['_comp_to'];
							$menu=fn_enp_main_prod_oprtor_table($str_comp_IDf,$str_comp_IDfr,$str_comp_IDto);
							$i=0;
							echo "
								<table style='border:1px solid black;border-collapse:collapse;' class='general_lbl'><thead>
								";
									while($i<sizeof($menu))
										{
											if($_header==0) 
												{
													echo "<tr bgcolor='" . $bgcolorh . "' style=\"font-weight:bold\">";
														for ($x=1; $x<=$menu[$i]['col99']; $x++)
															{
																if($x!=3)
																	{
																		$_col='col' . $x;
																		echo "<th 
																			style=\"border:1px solid black;
																			\"width=\"200\" \" height=\"32\" 
																			>
																				<font 
																					color=\"#FFFFFF\" style=\"font-weight:bold\">"
																					.$menu[$i][$_col].
																				"</font>
																			</th>";
																	}
															}
													echo "</tr></thead>";
												} 
											if($_header==1) 
												{
													if ($i&1)
														{
															echo "<tr bgcolor='" . $bgcolor1 . "'>";
															for ($x=1; $x<=$menu[$i]['col99']; $x++)
																{
																	if($x!=3)
																		{
																			$_col='col' . $x;
																			If($menu[$i]['col4']=='Opr')
																				{
																					$fcolor=$fcolor1;
																				}
																			else
																				{
//																					$fcolor=$fcolor2;
																					$fcolor='#000000';
																				}
																					If($x<5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>" 
																							.$menu[$i][$_col]. 
																					"</font></th>";
																						}
																					If($x==5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>" 
																							. number_format($menu[$i][$_col],2) . 
																					"%</font></th>";
																						}
																					If($x>5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>" 
																							. number_format($menu[$i][$_col],2) . 
																					"</font></th>";
																						}
																		}
																}
															echo "</tr>";
														}
													else
														{
															echo "<tr bgcolor='" . $bgcolor2 . "'>";
															for ($x=1; $x<=$menu[$i]['col99']; $x++)
																{
																	if($x!=3)
																		{
																			$_col='col' . $x;
																			If($menu[$i]['col4']=='Opr')
																				{
																					$fcolor=$fcolor1;
																				}
																			else
																				{
//																					$fcolor=$fcolor2;
																					$fcolor='#000000';
																				}
																					If($x<5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>"  
																								. $menu[$i][$_col] . 
																				"</font></th>";
																						}
																					If($x==5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>"  
																							. number_format($menu[$i][$_col],2) . 
																				"% </font></th>";
																						}
																					If($x>5)
																						{
																			echo "<th 
																				style=\"border:1px solid black;
																				\"width=\"200\" \" height=\"32\" 
																				>
																					<font 
																						color='" . $fcolor . "'>"  
																							. number_format($menu[$i][$_col],2) . 
																				"</font></th>";
																						}
																		}
																}
															echo "</tr>";
														}
												} 
											$_header=1;
											$i++;
										}
							echo "</table>";
						}
				}
		?>
	<!-- *** end of Operator Information Grid Details *** -->
<!-- *** end of Monthly Information Regarding Operator *** -->
