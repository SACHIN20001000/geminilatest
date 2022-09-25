<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard';
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Role;
use common\models\User;
?>
<style type="text/css">
	.main_container {
		width: 100%;
		margin: 50px auto;
		padding: 0 35px;
	}
	.grid-item {
		background: #FFFFFF;
		box-shadow: 0px 2px 12px rgba(32, 56, 85, 0.10);
		border-radius: 12px;
		padding: 20px;
	}
	.item-01 {  grid-area: g1;}
	.item-02 {  grid-area: g2;}
	.item-03 {  grid-area: g3;}
	.item-04 {  grid-area: g4;}
	.item-05 {  grid-area: g5;}
	.item-06 {  grid-area: g6;}
	.item-07 {  grid-area: g7;}
	.grid-wrapper {
	    display: grid;
		grid-template-areas: 'g1 g1 g2 g2 g3 g3 g4 g4 g4' 
		                     'g1 g1 g2 g2 g3 g3 g7 g7 g7' 
		                     'g5 g5 g5 g6 g6 g6 g7 g7 g7' 
		                     'g5 g5 g5 g6 g6 g6 g7 g7 g7'; 
		grid-gap : 35px;
	}
	.d-flex {
		display: flex;
	}
	.color-lg-blue {
		color: #253858 !important;
	}
	.color-gray {
		color: #5F5F5F !important;
	}
	.color-green {
		color: #02BC7B !important;
	}
	.color-red {
		color: #EB3232;
	}
	span {
		color: #5F5F5F;
		font-family: 'Roboto';
		font-style: normal;
		font-weight: 400;
		font-size: 14px;
		line-height: 12px;
	}
	.flex-center-start {
	    display: flex;
	    justify-content: start;
	    align-items: center;
	    grid-gap: 15px;
	    margin-top: 25px;
	}
	.flex-center-start>span {
	    width: 45%;
	}
	/* _______ CSS For inner Content ______ */
	.top-box {
	    display: flex;
	    justify-content: space-between;
	    align-items: center;
	}
	.dark-title {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: 700;
		font-size: 20px;
		line-height: 26px;
		color: #000000;
		margin: 0;
	}
	.health .flex-center-start>span:first-child {
	    width: 30%;
	}
	.health .flex-center-start>span:last-child {
	    width: 65%;
	}

	/*   _____ CSS For Invoice box __________ */
	.invoices-btm {
	    display: flex;
	    justify-content: space-between;
	    margin-top: 30px;
	}
	.invoice-price {
		font-family: 'Roboto';
		font-weight: 500;
		font-size: 22px;
		line-height: 1.35;
		letter-spacing: 0.3px;
		color: #5E5E5E;
	}
	.invoices-left>span {
		font-weight: 700;
	}
	.invoices-right-inn>span {
	    min-width: 80px;
	    display: inline-block;
	    padding-bottom: 10px;
	}

	/* ________ CSS For Add Teams _______ */
	.black-btn {
	    background: #000;
	    color: #fff;
	    border: 0;
	    padding: 7px 15px;
	    line-height: 1;
	    border-radius: 20px;
	    font-size: 14px;
	    min-width: 80px;
	}
	.black-btn span {
	    color: #ffff;
	    font-size: 17px;
	    line-height: 1;
	    padding-right: 5px;
	}
	.teams-items {
	    display: grid;
	    grid-template-columns: 20% 70% 10%;
	    justify-content: space-between;
	    margin-top: 20px;
	}
	.delete-icons {
	    width: 22px;
	    background: #7E7E7E;
	    height: 22px;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    border-radius: 50%;
	    overflow: hidden;
	}
	.delete-icons img {
	    width: 12px;
	}
	.users-img {
	    width: 45px;
	    height: 45px;
	    border-radius: 50%;
	    object-fit: cover;
	}
	.member-name {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: 600;
		font-size: 20px !important;
		line-height: 1.25 !important;
		color: #000000;
	}
	.teams-wrap {
	    height: 325px;
	    overflow-y: scroll;
	    margin: 25px -20px 25px 0;
	}

	/* ______ CSS For Profilability ________ */
	.sm-title {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: 600;
		font-size: 14px;
		line-height: 12px;
		letter-spacing: 0.3px;
		color: #000000;
		mix-blend-mode: normal;
		margin: 25px 0 10px 0;
	}
	.over-target {
	    background: #E8E8E8;
	    text-align: center;
	    padding: 15px 25px;
	    border-radius: 15px;
	}
	.round-box {
	    background: #F9F9F9;
	    border-radius: 15px;
	    display: flex;
	    justify-content: space-between;
	    align-items: center;
	    padding-left: 25px;
	}
	.dark-total {
		color: #494949;
		font-weight: 700;
	}
	.per-text {
		font-weight: 700;
		font-size: 16px;
	}

	/*  ______  CSS For Bottom section _____ */
	.main_container.btm-section {
	    display: grid;
	    grid-template-columns: 43% 54%;
	    justify-content: space-between;
	}
	.btm-section-second {
	    display: flex;
	    flex-direction: column;
	    grid-gap: 35px;
	}
	.workstream-items {
	    display: grid;
	    grid-template-columns: 60px calc(100% - 60px);
	    margin-top: 25px;
	}
	.workstream-text h3 {
	    font-family: 'Roboto';
	    font-style: normal;
	    font-weight: 400;
	    font-size: 16px;
	    line-height: 19px;
	    color: #A3A3A3;
	    margin: 8px 0 ;
	}
	.bold-text {
	    color: #000;
	    font-weight: 600;
	}
	.time {
	    padding-left: 14px;
	    font-size: 12px;
	}
	.workstream-text p {
		font-family: "Roboto";
	    border-bottom: 1px solid #D8D8D8;
	    padding-bottom: 17px;
	}
	.workstream-items .users-img {
	    width: 35px;
	    height: 35px;
	}
	.arrow-down-btn {
	    border: 1px solid #000000;
	    background: #fff;
	    padding: 3px 15px;
	    border-radius: 15px;
	    display: block;
	    margin: 20px auto 5px;
	}
	.arrow-down-btn img {
	    transform: rotate(-90deg);
	}



	/* _______ CSS For Table _______ */
	table.dataTable thead th {
	    padding: 5px 7px;
	    border-bottom: 1px solid #c2c2c2;
	    font-family: 'Roboto';
	    font-style: normal;
	    font-weight: 500;
	    font-size: 11px;
	    line-height: 1;
	    color: #979797;
	}
	table.dataTable tbody td {
	    padding: 7px;
	    font-family: 'Roboto';
	    font-style: normal;
	    font-weight: 400;
	    font-size: 12px;
	    line-height: 1;
	    letter-spacing: 0.01em;
	    color: #000000;
	    white-space: nowrap;
	}
	table.dataTable.display tbody tr {
	    background-color: #f9f9f9;
	}
	tbody tr:first-child td {
	    border-top: 25px solid #fff !important;
	}
	tbody tr td:last-child {
	    padding-right: 5px !important;
	}
	table.dataTable.no-footer {
	     border-bottom: 0px solid #111; 
	}
	table.dataTable.display tbody td {
		border-bottom: 0px solid #F9F9F9 !important;
	    border-top: 8px solid #fff;
	}
	thead tr .first-child {
	    padding-left: 0px !important;
	}
	table.dataTable thead .sorting {
	    background-size: 0;
	}
	table span {
		font-size: 12px;
	}
	.assign-img img {
	    width: 27px;
	    height: 27px;
	    border-radius: 50%;
	    object-fit: cover;
	    margin-right: -7px;
	}
	.tags-td {
		min-width: 80px;
	}
	.tags {
	    color: #fff;
	    font-size: 11px;
	    line-height: 1;
	    background: #fff;
	    padding: 5px 10px;
	    width: 100%;
	    text-align: left;
	    display: block;
	    border-radius: 4px;
	}
	.bg-blue {
		background: #496FE9;
	}
	.bg-red {
		background: #EB3232;
	}
	.play-icons {
	    width: 25px;
	    height: 25px;
	    background: #979797;
	    object-fit: contain;
	    padding: 8px;
	    border-radius: 4px;
	}
	.dataTables_paginate, .dataTables_info {
	    display: none;
	}
	.table-section {
	    margin-bottom: 20px;
	}

	@media (max-width: 1450px) {
		.main_container {
		    padding: 0 15px;
		}
	}
	.selectedoption {
    color: #fff;
    font-size: 12px;
    text-align: center;
    height: 34px;
    line-height: 34px;
    cursor: pointer;
    width: 110px;
    font-family: 'SF UI Display';
}
.myoptions {
	display: none;
    position: absolute;
    z-index: 10;
    background: #fff;
    padding: 10px 15px;
    border: 1px solid #ccc;
    top: 34px;
	left: -17px;
}
.optionselect,.optionworking, .optionwaiting, .optiondone, .optionstuck, .prioritytoselect, .prioritytoselectmodal, .prioritytoselectmodal.Low, .prioritytoselectmodal.Medium, .prioritytoselectmodal.High, .prioritytoselectmodal.Urgent 
 {
 color: #fff; font-size: 12px; font-family: 'Open Sans Bl'; text-align: center; height: 34px; line-height: 34px; width: 132px;	
}
.showforstatus, .showforpriorities { position: relative; }
.selectedoption .statusselect { background-color: #919191; }
.selectedoption .workingonit { background-color: #FEAC3B; }
.selectedoption .Waitingforreview { background-color: #549AFC; }
.selectedoption .statusdone { background-color: #00C875; }
.selectedoption .statusstuck { background-color: #ED7685; }
.selectedoption .priolow { background-color: #65CCFF; }
.selectedoption .priomedium { background-color: #A25BDC; }
.selectedoption .priohigh { background-color: #FFCC00; }
.selectedoption .priourgent { background-color: #E2445B; }
.myoptions div{ margin-bottom: 4px; cursor: pointer;}
.myoptions div:last-child { margin-bottom: 0px; }
.optionworking { background-color: #FEAC3B; color: #fff; font-size: 12px; font-family: 'Open Sans Bl'; text-align: center; height: 34px; line-height: 34px; width: 132px;		}
.optionselect { background-color: #919191; color: #fff; font-size: 12px; font-family: 'Open Sans Bl'; text-align: center; height: 34px; line-height: 34px; width: 132px;		}
.optionwaiting {background-color: #549AFC;color: #fff; font-size: 12px; font-family: 'Open Sans Bl'; text-align: center; height: 34px; line-height: 34px; width: 132px;	 }
.optiondone { background-color: #00C875;color: #fff; font-size: 12px; font-family: 'Open Sans Bl'; text-align: center; height: 34px; line-height: 34px; width: 132px;	 }
.optionstuck { background-color: #ED7685;color: #fff; font-size: 12px; font-family: 'Open Sans Bl'; text-align: center; height: 34px; line-height: 34px; width: 132px;	 }
.myoptions:before{
	content: url(<?= Url::base(true); ?>/images/icons/beforeniceselect.svg);	
	position: absolute;
	top: -14px;
	left: 50%;
}
.prioritytoselect.Low, .prioritytoselect.Medium,  .prioritytoselect.High, .prioritytoselect.Urgent,.prioritytoselect.Normal,.prioritytoselect.Select,
.prioritytoselectmodal.Low, .prioritytoselectmodal.Medium,  .prioritytoselectmodal.High, .prioritytoselectmodal.Urgent,.prioritytoselectmodal.Normal ,.prioritytoselectmodal.Select  { color: #fff; font-size: 12px; font-family: 'Open Sans Bl'; text-align: center; height: 34px; line-height: 34px; width: 132px; }
.prioritytoselect.Low, .statustoselectmodal.Low, .prioritytoselectmodal.Low { background-color: #65CCFF; }
.prioritytoselect.Medium, .statustoselectmodal.Medium, .prioritytoselectmodal.Medium { background-color: #A25BDC; }
.prioritytoselect.Normal, .statustoselectmodal.Normal, .prioritytoselectmodal.Normal { background-color: #A25BDC; }
.prioritytoselect.High, .statustoselectmodal.High, .prioritytoselectmodal.High { background-color: #FFCC00; }
.prioritytoselect.Select , .statustoselectmodal.Select,.prioritytoselectmodal.Select  { background-color: #919191; }
.prioritytoselect.Urgent, .statustoselectmodal.Urgent, .prioritytoselectmodal.Urgent { background-color: #E2445B; }

</style>
<section>
	<div class="main_container grid-wrapper">
		<div class="grid-item item-01 job-details">
			<div class="inner-wrap">
				<div class="top-box">
					<h3 class="dark-title">Job Details</h3>
					<img  src='<?= Url::base(true); ?>/images/icons/three-gray-dots.svg'>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Start Date</span>
					<span>04/05/2022</span>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Due Date</span>
					<span class="color-green">05/07/2022</span>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Account Manager</span>
					<span>Wasan Fayyad</span>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Project Type</span>
					<span>Social, SEO, Website</span>
				</div>
			</div>
		</div>
		<div class="grid-item item-02 health">
			<div class="inner-wrap">
				<div class="top-box">
					<h3 class="dark-title">Heath</h3>
					<img  src='<?= Url::base(true); ?>/images/icons/three-gray-dots.svg'>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Time</span>
					<span>14% ahead of schedule.</span>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Tasks</span>
					<span class="color-green">12 tasks to be completed.</span>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Workload</span>
					<span>0 tasks overdue.</span>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Progress</span>
					<span>14% complete.</span>
				</div>
				<div class="flex-center-start">
					<span class="color-lg-blue">Cost</span>
					<span>42% under budget.</span>
				</div>
			</div>
		</div>
		<div class="grid-item item-03">
			<div class="top-box">
				<h3 class="dark-title">Tasks</h3>
				<img  src='<?= Url::base(true); ?>/images/icons/three-gray-dots.svg'>
			</div>
		</div>  
		<div class="grid-item item-04">
			<div class="inner-wrap">
				<div class="top-box">
					<h3 class="dark-title">Invoicess</h3>
					<img  src='<?= Url::base(true); ?>/images/icons/three-gray-dots.svg'>
				</div>
				<div class="invoices-btm">
					<div class="invoices-left">
						<span>Total</span><br>
						<span class="invoice-price">3,500.00 AUD</span>
					</div>
					<div class="invoices-right">
						<div class="invoices-right-inn">
							<span class="color-green">Paid</span>
							<span class="color-green">2,000.00 AUD</span>
						</div>
						<div class="invoices-right-inn">
							<span class="color-red">Outstanding</span>
							<span class="color-red">1,500.00 AUD</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="grid-item item-05">
			<div class="inner-wrap">
				<div class="top-box">
					<h3 class="dark-title">Profitability</h3>
					<img  src='<?= Url::base(true); ?>/images/icons/three-gray-dots.svg'>
				</div>
				<h4 class="sm-title">One-Off</h4>
				<div class="round-box">
					<div>
						<span>Projected Budget</span><br>
						<span class="dark-total">$50,000</span>
					</div>
					<div>
						<span>Currently</span><br>
						<span class="dark-total">$50,000</span>
					</div>
					<div>
						<span>Remaining</span><br>
						<span class="dark-total">$50,000</span>
					</div>
					<div class="over-target">
						<span class="per-text color-red">8.1%</span><br>
						<span class="color-red">Over Target</span>
					</div>
				</div>
				<h4 class="sm-title">Recurring</h4>
				<div class="round-box">
					<div>
						<span>Projected Budget</span><br>
						<span class="dark-total">$50,000</span>
					</div>
					<div>
						<span>Currently</span><br>
						<span class="dark-total">$50,000</span>
					</div>
					<div>
						<span>Remaining</span><br>
						<span class="dark-total">$50,000</span>
					</div>
					<div class="over-target">
						<span class="per-text color-red">8.1%</span><br>
						<span class="color-red">Over Target</span>
					</div>
				</div>
			</div>
		</div>
		<div class="grid-item item-06">
			<p>6</p>
		</div>  
		<div class="grid-item item-07">
			<div class="inner-wrap">
				<div class="top-box">
					<h3 class="dark-title">Profitability</h3>
					<button class="black-btn"><span>+</span> Add</button>
				</div>
				<div class="teams-wrap">
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
					<div class="teams-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="member-details">
							<p class="member-name">John Doe</p>
							<span class="member-text">Copywriter</span>
						</div>
						<div class="delete-icons">
							<img  src='<?= Url::base(true); ?>/images/icons/delete-icons.svg'>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main_container btm-section">
		<div class="btm-section-first grid-item">
			<div class="inner-wrap">
				<h3 class="dark-title">Workstream</h3>
				<div class="workstream-wrap">
					<div class="workstream-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="workstream-text">
							<h3><span class="bold-text">Rony</span> "posted in" 
								<span class="bold-text">Social Media Content / Design</span> 
								<span class="time">Apr 11, 22    05:35 PM</span>
							</h3>
							<P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.....</P>
						</div>
					</div>
					<div class="workstream-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="workstream-text">
							<h3><span class="bold-text">Rony</span> "posted in" 
								<span class="bold-text">Social Media Content / Design</span> 
								<span class="time">Apr 11, 22    05:35 PM</span>
							</h3>
							<P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.....</P>
						</div>
					</div>
					<div class="workstream-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="workstream-text">
							<h3><span class="bold-text">Rony</span> "posted in" 
								<span class="bold-text">Social Media Content / Design</span> 
								<span class="time">Apr 11, 22    05:35 PM</span>
							</h3>
							<P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.....</P>
						</div>
					</div>
					<div class="workstream-items">
						<img class="users-img" src='<?= Url::base(true); ?>/images/icons/users-img.png'>
						<div class="workstream-text">
							<h3><span class="bold-text">Rony</span> "posted in" 
								<span class="bold-text">Social Media Content / Design</span> 
								<span class="time">Apr 11, 22    05:35 PM</span>
							</h3>
							<P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.....</P>
						</div>
					</div>
					<button class="arrow-down-btn"><img  src='<?= Url::base(true); ?>/images/icons/arrow-left-icon.svg'></button>
				</div>
			</div>
		</div>
		<div class="btm-section-second">
			<div class="btm-section-second grid-item">
				<h3 class="dark-title">Overdue (8)</h3>
				<div class="table-section">
					<table id="overdue" class="display tetable table-responsive overdue alloverdue" style="width:100%">
                        <thead>
                            <tr> 
                                <th class="first-child">Task Name</th> 
                                <th>Assignees</th> 
                                <th><span class="tags-td">Status</span></th>
                                <th><span class="tags-td">Priority</span></th>                  
                                <th>Start</th>                  
                                <th>Due</th>                    
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<!-- <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr><tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr> -->
                        </tbody>
                    </table>
				</div>
			</div>
			<div class="btm-section-second grid-item">
				<h3 class="dark-title">Today (8)</h3>
				<div class="table-section">
					<table id="overdue" class="display tetable table-responsive overdue" style="width:100%">
                        <thead>
                            <tr> 
                                <th class="first-child">Task Name</th> 
                                <th>Assignees</th> 
                                <th><span class="tags-td">Status</span></th>
                                <th><span class="tags-td">Priority</span></th>                  
                                <th>Start</th>                  
                                <th>Due</th>                    
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>
                            <tr> 
                                <td>Concept Development</td>
                                <td>
                                	<span class="assign-img">
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                	<img  src='<?= Url::base(true); ?>/images/icons/users-img.png'>
	                                </span>
                                </td>
                                <td><span class="tags bg-blue">To Do</span></td>
                                <td><span class="tags bg-red">Urgent</span></td>
                                <td>Mar 02</td>
                                <td><span class="color-red">Mar 02</span></td>
                                <td><img class="play-icons"  src='<?= Url::base(true); ?>/images/icons/start-btn.svg'></td>
                            </tr>

                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="invite" class="modal fade" role="dialog"  >
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content"> 
		  <div class="modal-body"> 
			<div class="modal-left">
				<div class="modal-top-title">Invite People  </div>
				<div class="modal-sub-title">Adcreators</div>
				<p class="modal-parag">
					An email will be sent inviting each person to this project. You can add multiple recipients and each of them will be sent a separate, personalized email.
				</p>
				<div class="modal-label">Select People</div>
				<div class="filter-block forcalendar">
					<select id="select-resource"  name="team[]" multiple="multiple">
					<?php
						$users = User::find()->where(['deleted'=>0])->orderBy(['user.first_name' => SORT_ASC])->all();
						foreach($users as $user){	
								$name = "";			
								$name .= (!empty($user->first_name)?$user->first_name." ":"");
								$name .= (!empty($user->last_name)?$user->last_name:"");
							echo "<option value=".$user->id.">".$name."</option>";
						}	
					?>
					</select>
				</div>
				<div class="modal-label">Message</div>
				<textarea class="modal-textarea" id="sendingmessage"  >Hi,&#13;&#10;Please click the link above to join me in a secure project workspace on Adcreators. In the workspace, we�ll be able to collaborate and track the project�s progress. As a first step, why not create a post about what you�re working on?&#13;&#10;Regards,
                </textarea>
				<div class="service">
					<label class="checkbox">
						 <input type="checkbox" name="services" value="5" checked/> 
						 <span class="default"></span>
					</label>
					<div class="text-label">Send this as default message</div>
				</div>
			</div>
			<?php 
				$name = "";			
				$name .= (!empty($currentuser->first_name)?$currentuser->first_name." ":"");
				$name .= (!empty($currentuser->last_name)?$currentuser->last_name:"");
			?>
			<div class="modal-right">
				<div class="modal-right-container">
					<div class="absolute-title">This is a preview of your message</div>
					<div class="second-modal-textarea">
						<div class="invite-from">From: <?= $name; ?> <span class="no-reply-email"><?= $currentuser->email ?></span></div>
						<div class="invite-subject">
							Subject: <span class="">[Project Invitation] </span> <span class="invited-by"><?= $name; ?></span> has invited you to
							<span class="invited-project"><?= $project->name; ?></span> on Adcreators
						</div>
						<div class="invited-date">Date: <?php $time = new \DateTime('now'); $today = $time->format('Y-m-d h:i A'); echo $today; ?></div>
						<div class="current-message">
							Hi,
							Please click the link above to join me in a secure project workspace on Adcreators. In the workspace, we�ll be able to collaborate and track the project�s progress. As a first step, why not create a post about what you�re working on? 
							Regards,
						</div>
						<a class="invited-link" href="javascript://">http://adcreatorsmanagement.com.au/activateproject</a>
						<div class="companyname">Adcreators</div> 
						<div class="poweredby">Powered by Adcreators.</div>
						<div class="privacy-email"> Privacy - Security - Email Settings </div>
						<div class="replynotreceived">Replies to this message will not be received. For assistance, please contact 
						<a class="support-email" href="info@adcreators.com">info@adcreators.com.au</a>.</div>
					</div>
					<div class="forbutton">
						<a href="#" class="forcancel">cancel</a>
						<button type="submit" class="submit-button sendemail">Send Invitation</button>
					</div>
				</div>
			</div>
		  </div> 
		</div>
	</div>
</div>






<?php $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.min.css'); ?>
<?php $this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js'); ?>    
<?php $this->registerJsFile(Url::base() . '/js/jquery-sortable.js'); ?> 
<?php $this->registerJsFile(Url::base() . '/js/ifvisible.js'); ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js
"></script>
<script type="text/javascript">
$(document).ready(function() {
  
    var myTable;
myTable =$('.overdue').DataTable({
	/* Disable initial sort */
        "aaSorting": [],
		"searching": false,
		"responsive" : true,
        "lengthChange": false,
     "pageLength": 3
	
        });
	
		$(".filter-block.forcalendar").click(function(e) {	
		alert('hi')	
			// $('.multiselect-container').hide();
			$(this).find('.multiselect-container').toggle();
	});
	$(document).mouseup(function(e) 
	{
			var container = $(".multiselect-container");

			// if the target of the click isn't the container nor a descendant of the container
			if (!container.is(e.target) && container.has(e.target).length === 0) 
			{
				container.hide();
			}
	});
});
</script>
<script>
$(document).ready(function() {
	
	$.ajax({
			url: '<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/showoverduetaskbyuser',
			type: 'post',
			data: {
 				id: '<?php echo $project->id; ?>',
			},
			dataType: "json",
			success: function (data) {
				$('.overdueuser tbody').html(data['html']); 
			}
		});
	$.ajax({
			url: '<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/showalloverduetasks',
			type: 'post',
			data: {
 				id: '<?php echo $project->id; ?>',
			},
			dataType: "json",
			success: function (data) {
				$('.alloverdue tbody').html(data['html']); 
				$('.selecteduser').multiselect({
								includeSelectAllOption: false,
								 enableFiltering: true,
								 enableHTML: true,
								 optionLabel: function(element) {
								 return '<img src="<?= Url::base(); ?>/uploads/users/'+ $(element).attr('data-img')+'"> '+ $(element).text();
								},
								buttonText: function(options, select) {
									var icons='';
									if(options.length==0){
										$(this).parent().find('div.btn-group').find('span.multiselect-selected-text').html('Non Selected');	
										icons = '<span class="no-user-selected">Non Selected</span>';
										return icons;
									}else{
									options.each(function () {
											icons +='<img class="selectedicon" src="<?= Url::base(); ?>/uploads/users/'+ $(this).attr('data-img')+'"> ';
										});
										$(this).parent().find('div.btn-group').find('span.multiselect-selected-text').html(icons);	
										return icons;
									}
								},
								enableCaseInsensitiveFiltering: true,
							   // buttonWidth: '100%',
								buttonClass: 'custombuttonmulti firstselect0', 
								onChange: function(option, checked, select) {
									var value = option[0].value;
									var task_id =option[0].attributes.data_task_id.value;

									$.ajax({
										url: '<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/changeassignuser',
										type: 'post',
										data: {
											value: value,
											task_id: task_id,
										},
										dataType: "text",
										success: function (data) {
											if(data == "error"){
 												location.reload();
											}
										},
										complete: function(data) {
 										}
									});
						
								}
						     });
			}
		});
	$.ajax({
			url: '<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/showteamsection',
			type: 'post',
			data: {
 				id: '<?php echo $project->id; ?>',
			},
			dataType: "json",
			success: function (data) {
 				$('.firstbox').html(data['html']); 
			}
		});
	$("#team").show();
	var project_id = '<?php echo $project->id; ?>';
	$('#select-resource').multiselect({
		enableFiltering:true,
		enableCaseInsensitiveFiltering:true,
		includeSelectAllOption: false,
		buttonWidth: '100%',
		buttonClass: 'custombuttonmulti secondselect',
    });
	$('span.multiselect-selected-text').html('People');
	//$( "a.offsite" ).live( "click", function() {
		$('select').niceSelect();
    $(document).on('click', '.black-btn', function () {
 	   $('#invite').modal('show');
	   $('.type').niceSelect();
    });
	
    $(document).on('click', '.selectedoption', function () { 
		$(this).parent().find('.myoptions').toggle();
	});
	$(document).mouseup(function(e) 
	{
		var container = $(".myoptions");
		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			container.hide();
		}
	});
	$(document).on('click', '.statustoselect', function () { 
		var selectedstatus = $(this).attr('data-id');
		var selectid = $(this).parents('.showforstatus').attr('data-id');
		if(selectedstatus==0){
			//$(this).parent().parents().find('.selectedoption').html('<div class="statusselect">Select</div>');
			$(this).parent().parent().find('.selectedoption').html('<div class="statusselect">Select</div>');
			$('.selectedoption#forstatus'+selectid).html('<div class="statusselect">Select</div>');
		}else if(selectedstatus==1){
			$(this).parent().parent().find('.selectedoption').html('<div class="workingonit">Working on it</div>');
			$('.selectedoption#forstatus'+selectid).html('<div class="workingonit">Working on it</div>');
		}else if(selectedstatus==2){
			$(this).parent().parent().find('.selectedoption').html('<div class="Waitingforreview">Waiting for review</div>');
			$('.selectedoption#forstatus'+selectid).html('<div class="Waitingforreview">Waiting for review</div>');
		}else if(selectedstatus==3){
			$(this).parent().parent().find('.selectedoption').html('<div class="statusdone">Done</div>');
			$('.selectedoption#forstatus'+selectid).html('<div class="statusdone">Done</div>');
		}else if(selectedstatus==4){
			$(this).parent().parent().find('.selectedoption').html('<div class="statusstuck">Stuck</div>');
			$('.selectedoption#forstatus'+selectid).html('<div class="statusstuck">Stuck</div>');
		}
		

		$(this).parent().parent().find('.myoptions').hide();
		$.ajax({
			url: '<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/changestatus',
			type: 'post',
			data: {
				value: selectedstatus,
				task_id: selectid,
			},
			dataType: "json",
			success: function (data) {
				if(data['status'] == "error"){ 
					location.reload();
				}
			}
		});

		
	});
	$(document).on('click', '.prioritytoselect,.prioritytoselectmodal', function () {
		
		var selectedstatus = $(this).attr('data-id');
		var selectid = $(this).parents('.showforpriorities').attr('data-id');
		if(selectedstatus==0){
			$(this).parent().parent().find('.selectedoption').html('<div class="statusselect"> Select </div>');
			$('.selectedoption#forprio'+selectid).html('<div class="statusselect"> Select </div>');
		}else if(selectedstatus==1){
			$(this).parent().parent().find('.selectedoption').html('<div class="priolow"> Low </div>');
			$('.selectedoption#forprio'+selectid).html('<div class="priolow"> Low </div>');
		}else if(selectedstatus==2){
			$(this).parent().parent().find('.selectedoption').html('<div class="priomedium">Normal</div>');
			$('.selectedoption#forprio'+selectid).html('<div class="priomedium">Normal</div>');
		}else if(selectedstatus==3){
			$(this).parent().parent().find('.selectedoption').html('<div class="priohigh">High</div>');
			$('.selectedoption#forprio'+selectid).html('<div class="priohigh">High</div>');
		}else if(selectedstatus==4){
			$(this).parent().parent().find('.selectedoption').html('<div class="priourgent">Urgent</div>');
			$('.selectedoption#forprio'+selectid).html('<div class="priourgent">Urgent</div>');
		}
		$(this).parent().parent().find('.myoptions').hide();

		$(".changepriority"+selectid).val(selectedstatus);
		$.ajax({
			url: '<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/changepriority',
			type: 'post',
			data: {
				value: selectedstatus,
				task_id: selectid,
			},
			dataType: "text",
			success: function (data) {
				if(data == "error"){
					location.reload();
				}
			}
		});
		
		//$(".changepriority"+selectid).trigger('change');
	});
	$(document).on("click",".sendemail",function() {
		var message = $('#sendingmessage').val();
		var team= $('#select-resource').val();

		$.ajax({
			url:'<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/invitteam',
			type: 'post',
			data: {message:message,team:team,project_id:project_id},
			dataType: "text",
			success: function (data) { 
				$('#invite').modal('hide');
				$('#showMessageModal').modal('show');
				$('#showMessageModal .modal-header h4').html('Email Sent');
			}
		});
	});
	$(document).on("click",".icon_delete_user",function() {
		var user_id = $(this).attr('data_id');
		
		$.simpleDialog({
			title: "Are you sure you want to delete?",
			message: "",
			confirmBtnText: "Yes",
			closeBtnText: "Cancel",
			backdrop:true,
			onSuccess: function () {
				$.ajax({
					url:'<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/deleteuser',
					type: 'post',
					data: {user_id:user_id,project_id:project_id},
					dataType: "text",
					success: function (data) { 
						if (data == "success") {
							$('.combination'+user_id).remove();
							 $('.confirmdialog').modal('hide');
						} else {
							   $('.confirmdialog').modal('hide');
						}
					}
				});
			},
			onCancel: function () {
				 return false;
				
			}
		});
	
	});
	
		
	$(document).on("change","#type",function() {
		var role_id = $(this).val();
		$.ajax({
			url:'<?php echo Yii::$app->getUrlManager()->createUrl(''); ?>accounts/getusers',
			type: 'post',
			data: {role_id:role_id},
			dataType: "html",
			success: function (data) { 
				$('#select-resource').html(data);
				$("#select-resource").multiselect('destroy');

				$('#select-resource').multiselect({
					  includeSelectAllOption: false,
					  buttonWidth: '100%',
					  buttonClass: 'custombuttonmulti secondselect',
				});
			}
		});
    });
	
   $(".forcalendar").click(function(e) {
	   if( $('.multiselect-container :visible').length == 0 ){
		   $('.multiselect-container').show();
	   }else{
	    $('.multiselect-container').hide();
	   }
		
   });
  
   $(document).mouseup(function(e) 
	{
		var container = $(".multiselect-container");
        var container2 = $(".forcalendar");
		// if the target of the click isn't the container nor a descendant of the container
		if ( (!container.is(e.target) && container.has(e.target).length === 0)  && (!container2.is(e.target) && container2.has(e.target).length === 0) ) 
		{
			container.hide();
		}
	});	
	
	
	
	$(".forcancel").click(function(e) {
		 $('#invite').modal('hide');
	});		
	$('#sendingmessage').on('input', function() {
       $('.current-message').html($('#sendingmessage').val());
    }); 
	$(document).on('click', '.style-team', function () {	
	   $('.style-team').removeClass('activesection');
	   $(this).addClass('activesection');
	   $('.team-section').hide(); 
	   var block = $(this).attr('data-id');
	   $("#"+block).show();
 	});
	
	$(document).on('click', '.firstboxa.asection', function (e) {	
	  e.preventDefault(); 
	});
	$(document).on('click', '.displaymonthheader', function () {
	  if($(this).hasClass('toopen')){
		  $(this).removeClass('toopen');
	  }else{
		  $(this).addClass('toopen');
	  }
	  $(this).parent().find('.displaymonthcontainer').toggle();
 	});
	
	});	
	
</script>
