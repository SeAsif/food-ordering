<link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?= base_url() ?>css/cupertino/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<style type="text/css">
  body {
    background: 0px none !important;
  }
</style>

<style>
  form,
  body {
    box-shadow: none !important;
  }

  td {
    font-size: 16px !important;
  }

  input.txt-field,
  input.form-control,
  .txtarea,
  .custom-select,
  select {
    display: inline-block;
    width: 70%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }

  a.global-link span {
    background-image: none !important;
    color: white !important;
  }

  a img {
    display: none !important;
  }

  a.global-link {
    background: none !important;
    border-color: transparent !important;
    color: white !important;
    outline: none !important;
    min-height: 30px !important;
    border-radius: 5px !important;
    font-size: 15px !important;
    min-width: 30px !important;
    background-color: #f36737 !important;
  }
</style>
<div class="add-item">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="3" style="padding-bottom:7px; padding-top:0px;">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td style="width:50%;">
              <strong><?= $variantGroup["group_name"] ?></strong>
              <span style="padding-left:10px;">(<?= ($variantGroup["required"] == "Yes") ? "Required" : "Not Required" ?> / <?= $variantGroup["selection"] ?>)</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <?
	  $nCount	=	1;
      foreach ($variantItems as $variantItem)
	  {
	  	if (($nCount%4)	==	0)
		echo "</tr><tr>";
	  ?>
      <td>
        <?= $variantItem["name"] ?> <span style="padding-left:5px;">(₦<?= $variantItem["price"] ?>)</span>
      </td>
      <?
	  	$nCount++;
	  }
      ?>
    </tr>
  </table>
</div>