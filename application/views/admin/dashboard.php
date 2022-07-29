<?
		$this->load->view( 'admin/header_view');
?>

<table width="70%" border="0" align="center" cellpadding="2" cellspacing="2" class="input1">
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td width="25%">
            <div align="center"> <a href="admins/" class="linkHome"
                    onMouseOver="window.status='Manage Admins'; return true;"
                    onMouseOut="window.status=''; return true;"> <img src="<?=base_url()?>images/icons/otherpages.jpg"
                        width="31" height="37" border="0"></a> </div>
        </td>
        <td width="25%">
            <div align="center"> <a href="users/" class="linkHome"
                    onMouseOver="window.status='Manage Users'; return true;"
                    onMouseOut="window.status=''; return true;"> <img src="<?=base_url()?>images/icons/otherpages.jpg"
                        width="31" height="37" border="0"></a> </div>
        </td>
        <td width="25%">
            <div align="center"> <a href="<?=base_url()?>adminrestaurant/" class="linkHome"
                    onMouseOver="window.status='Manage Restaurants'; return true;"
                    onMouseOut="window.status=''; return true;" target="mainFrame"> <img
                        src="<?=base_url()?>images/icons/otherpages.jpg" width="31" height="37" border="0"></a> </div>
        </td>

        <td>
            <div align="center"> <a href="<?=base_url()?>adminorder" class="linkHome"
                    onMouseOver="window.status='Manage Users'; return true;" onMouseOut="window.status=''; return true;"
                    target="mainFrame"> <img src="<?=base_url()?>images/icons/otherpages.jpg" width="31" height="37"
                        border="0"></a> </div>
        </td>

    </tr>
    <tr>
        <td>
            <div align="center"> <a href="admins/" class="linkHome"
                    onMouseOver="window.status='Manage Admins'; return true;"
                    onMouseOut="window.status=''; return true;">Manage<br>
                    Admins</a> </div>
        </td>
        <td>
            <div align="center"> <a href="users/" class="linkHome"
                    onMouseOver="window.status='Manage Users'; return true;"
                    onMouseOut="window.status=''; return true;">Manage<br>
                    Users</a> </div>
        </td>
        <td>
            <div align="center"> <a href="<?=base_url()?>adminrestaurant/" class="linkHome"
                    onMouseOver="window.status='Manage Restaurants'; return true;"
                    onMouseOut="window.status=''; return true;">Manage<br>
                    Restaurants</a> </div>
        </td>
        <td>
            <div align="center"> <a href="<?=base_url()?>adminorder" class="linkHome"
                    onMouseOver="window.status='Manage Users'; return true;"
                    onMouseOut="window.status=''; return true;">Manage<br>
                    Orders</a> </div>
        </td>
    </tr>
    <tr>

        <!-- <td><div align="center"> <a href="<?=base_url()?>adminpaymenthistory" class="linkHome"
					onMouseOver="window.status='Manage Payment History'; return true;"
					onMouseOut="window.status=''; return true;"> <img src="<?=base_url()?>images/icons/otherpages.jpg" width="31" height="37" border="0"></a> </div></td>
            <td></td> -->
    </tr>
    <tr>

        <!-- <td><div align="center"> <a href="<?=base_url()?>adminpaymenthistory" class="linkHome"
						onMouseOver="window.status='Manage Payment History'; return true;"
						onMouseOut="window.status=''; return true;">Manage<br>
            Payment History</a></div></td> -->
        <td></td>
    </tr>
</table>

<?
$this->load->view("admin/inc/footer");
?>