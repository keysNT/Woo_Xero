<?php

?>
<style>
    *{margin: auto;}
    caption{
        font-size: 20px;
        margin-bottom: 30px;
        color: #0A246A;
    }
    table {
        width: 90%;
    }

    th {
        height: 30px;
    }
    th, td {
        padding: 15px;
        text-align: left;
    }
    th {
        background-color: #000000;
        color: white;
    }
    .cap{
        font-size: 18px;
    }
    input[type=submit]{
        height: 30px;
        padding: 5px;
        font-size: 14px;
        font-weight: bold;
        font-family: "Open Sans";
        text-transform: uppercase;
        color: #696666;
        border-radius: 2px;
        border: 0.15em solid #F9C23C;
        cursor: pointer;
        transition: all 0.3s ease 0s;
    }
    input[type="submit"]:hover {
        color: #fff;
        background-color: #EAA502;
        border-color: #EAA502;
        background-position: 0.75em bottom;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
</style>
<?php
var_dump($link);

?>
<a href="<?= WOOXERO_PATH .'controllers/xero-connector-controoler.php' ?>">aaaaaa</a>
<table cellpadding="0" cellspacing="0" style="text-align: left;">
    <caption>
        <?php echo __('Equeue sync Salesforce', 'SALESFORCE_TEXT_DOMAIN');?>
    </caption>
    <tr>
        <td colspan="6" class="cap">
            <?php echo __('Equeue order sync Salesforce', 'SALESFORCE_TEXT_DOMAIN');?>
        </td>

    </tr>
    <tr>
        <th><?php echo __('Order id', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Account name', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Email', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Product', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Order amount', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Order date', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Sync', 'SALESFORCE_TEXT_DOMAIN'); ?></th>
    </tr>
</table>


<table cellpadding="0" cellspacing="0" style="text-align: left; margin-top: 100px;">
    <tr>
        <td colspan="6" class="cap">
            <?php echo __('Equeue lead sync Salesforce', 'SALESFORCE_TEXT_DOMAIN');?>
        </td>

    </tr>
    <tr>
        <th><?php echo __('ID', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('User id', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Account name', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Email', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Date create', 'SALESFORCE_TEXT_DOMAIN');?></th>
        <th><?php echo __('Sync', 'SALESFORCE_TEXT_DOMAIN'); ?></th>
    </tr>
</table>
