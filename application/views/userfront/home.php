<?
$this->load->view("userfront/header_view");
?>

<!-- Start Auto Complete Drop Down CSS -->
<style>
	.ui-button {
		margin-left: -28px;
		border: 0px none !important;
		background: none !important;
		background-image: url(images/down.gif) !important;
		background-repeat: no-repeat !important;
		background-position: 6px 10px !important;
		background-color: #F0F0F0 !important;
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
	}

	.ui-button-icon-only .ui-button-text {
		padding: 0.35em;
	}

	.ui-autocomplete-input {
		background: 0px none !important;
		background-color: #F0F0F0 !important;
		border: 1px solid #676767 !important;
		color: #5D5D5D !important;
		font-size: 11px !important;
		padding: 5px !important;
		width: 252px !important;
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
	}
</style>
<!-- End Auto Complete Drop Down CSS -->

<script>
	$(function() {
		$("#flight_date").datepicker();
	});

	(function($) {
		$.widget("ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children(":selected"),
					value = selected.val() ? selected.text() : "";
				var input = this.input = $("<input>")
					.insertAfter(select)
					.val(value)
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function(request, response) {
							var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
							response(select.children("option").map(function() {
								var text = $(this).text();
								if (this.value && (!request.term || matcher.test(text)))
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>"),
										value: text,
										option: this
									};
							}));
						},
						select: function(event, ui) {
							ui.item.option.selected = true;
							self._trigger("selected", event, {
								item: ui.item.option
							});
							document.getElementById('combobox1').value = ui.item.option.text;
							showTerminals(ui.item.option.value);
						},
						change: function(event, ui) {
							if (!ui.item) {
								var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex($(this).val()) + "$", "i"),
									valid = false;
								select.children("option").each(function() {
									if ($(this).text().match(matcher)) {
										this.selected = valid = true;
										return false;
									}
								});
								if (!valid) {
									// remove invalid value, as it didn't match anything
									$(this).val("");
									select.val("");
									input.data("autocomplete").term = "";
									return false;
								}
							}
						}
					})
					.addClass("ui-widget ui-widget-content ui-corner-left");

				input.data("autocomplete")._renderItem = function(ul, item) {
					return $("<li style='font-weight:bold;'></li>")
						.data("item.autocomplete", item)
						.append("<a>" + item.label + "</a>")
						.appendTo(ul);
				};

				this.button = $("<button type='button'>&nbsp;</button>")
					.attr("tabIndex", -1)
					.attr("title", "Show All Items")
					.insertAfter(input)
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass("ui-corner-all")
					.addClass("ui-corner-right ui-button-icon")
					.click(function() {
						// close if already visible
						if (input.autocomplete("widget").is(":visible")) {
							input.autocomplete("close");
							return;
						}

						// pass empty string as value to search for, displaying all results
						input.autocomplete("search", "");
						input.focus();
					});
			},

			destroy: function() {
				this.input.remove();
				this.button.remove();
				this.element.show();
				$.Widget.prototype.destroy.call(this);
			}
		});
	})(jQuery);

	$(function() {
		$("#combobox").combobox();
		$("#toggle").click(function() {
			$("#combobox").toggle();
		});
	});
</script>

<!-- Start Menu Popups -->

<script language="javascript">
	var base_url = "<?= base_url() ?>";
	var itemId;

	function openAirport(nAirportId) {
		airportId = nAirportId;
		$('#airport-message').dialog('open');
		return false;
	}
</script>

<script type="text/javascript">
	$(function() {
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#airport-message').dialog({
			autoOpen: false,
			modal: true,
			width: 'auto',fluid:true,responsive: true,
				maxWidth:300,
		});

	});
</script>

<!-- End Menu Popups -->

<script language="javascript" src="<?= base_url(); ?>js/frontfunctions.js"></script>


<!-- Start Popup -->
<div id="airport-message" title="Add Airport" style="display:none;">
	<?
					$this->load->view("userfront/airport");
				?>
</div>
<!-- End Popup -->

<div class="cont-wrap">
	<div class="cont-round"><img src="<?= base_url() ?>images/front/form-top.jpg" alt="top" border="0" /></div>
	<div class="cont-mid">
		<div class="cont-rpt">
			<!-- Start Mid Cont Left -->
			<div class="cont-left">
				<p>Order in Advance. Save Time.<br />Get a good meal for your flight<br /></p>
				<!--<a href="#" class="readmore">read more</a>-->
			</div>
			<!-- End Mid Cont Left -->
			<form action="<?= base_url() ?>home" method="post">
				<!-- Start Mid Cont Right -->
				<div class="cont-right">
					<div class="right-form">
						<h2>Search Restaurants</h2>
						<div class="form">

							<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

								<tr>
									<td>

										<?
                                             if(isset($errors))  	
                                             {
                                               if (isset($errors) && count($errors) > 0)
                                               {
											   ?>
										<div class="ui-widget">
											<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
												<?
                                                   foreach ($errors as $error)
                                                   {
                                                    echo $error;
                                                   }
												?>
											</div>
										</div>
										<?
                                               }
                                             } 
                                            ?>
									</td>
								</tr>
								<tr>
									<td><strong>Your Location:</strong></td>
								</tr>
								<tr>
									<td>
										<input name="airport" type="hidden" class="txt-field" id="combobox1" value="<?= $arrReturn["airport"] ?>" />
										<input type="hidden" id="airportid" name="airportid" value="<?= $arrReturn["airportid"] ?>" />
										<select id="combobox" class="combowd float-left" name="airport1">
											<option value="-1">Please Select</option>
											<?
                                        foreach ($airportArr as $airports)
										{
										?>


											<option value="<?= $airports["id"] ?>" <? if($airports["id"]==$arrReturn["airportid"]) echo"Selected=''";?>><?= $airports["airport_name"] ?></option>
										<?
										}
										?>
                                    </select>
                                    <a href=" JavaScript:void(0);" onclick="openAirport(0);" class="time" style=" display:block; margin-top:5px;">
												<strong><em>click here</em> if you dont see your airport</strong>
												</a>

												<!--<input name="airportid" type="hidden" class="txt-field" id="combobox" value="<?= $arrReturn["airportid"] ?>" />-->
									</td>
								</tr>
								<tr>
									<td style="padding-top:6px;"><strong>Select Terminal:</strong></td>
								</tr>
								<tr>
									<td>
										<input name="terminal" type="hidden" class="txt-field" id="combobox1" value="<?= $arrReturn["terminal"] ?>" />
										<select id="terminal" name="terminal" class="combowd float-left">
											<?
                                	foreach ($terminalList as $terminalInfo)
									{
								?>
											<option value="<?= $terminalInfo["id"] ?>" <?= ($terminalInfo["id"] == $arrReturn["terminal"]) ? 'selected="selected"' : '' ?>><?= $terminalInfo["terminal_name"] ?></option>;
											<?
									}
								?>
										</select>
									</td>
								</tr>
								<tr>
									<td style="padding-top:6px;"><strong>Flight Date:</strong></td>
								</tr>
								<tr>
									<td><input name="flight_date" type="text" class="txt-field" id="flight_date" value="<?= $arrReturn["flight_date"] ?>" /></td>
								</tr>
								<tr>
									<td style="padding-top:8px;"><strong>Flight Departure Time</strong></td>
								</tr>
								<tr>
									<td>
										<select name="flight_time_hour" class="combowd float-left" style="width:78px; margin-right:10px;">
											<option value="">HH</option>
											<?
                                        for ($i=1;$i<=12;$i++)
										{
										?>
											<option value="<?= $i ?>" <?= ($arrReturn["flight_time_hour"] == $i) ? 'selected="selected"' : '' ?>>
												<? if($i<10) echo 0;?><?= $i ?>
											</option>
											<?
                                        }
										?>
										</select>
										<select name="flight_time_minute" class="combowd float-left" style="width:80px; margin-right:10px;">
											<option value="">MM</option>
											<?
                                        for ($i=0;$i<60;$i++)
										{
										?>
											<option value="<?= $i ?>" <?= ($arrReturn["flight_time_minute"] == $i) ? 'selected="selected"' : '' ?>>
												<? if($i<10) echo 0;?><?= $i ?>
											</option>
											<?
											$i+=4;
                                        }
										?>
										</select>
										<select name="flight_time_type" class="combowd float-left" style="width:78px;">
											<option value="AM" <?= ($arrReturn["flight_time_type"] == "AM") ? 'selected="selected"' : '' ?>>AM</option>
											<option value="PM" <?= ($arrReturn["flight_time_type"] == "PM") ? 'selected="selected"' : '' ?>>PM</option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="padding-top:6px;">
										<table width="100%" border="0" cellspacing="2" cellpadding="0">
											<!--<tr>
                                        <td><input name="btn" type="radio" style="margin:0px;" value="" checked="checked" /></td>
                                        <td>Terminal / Airline</td>
                                        <td><input name="btn" type="radio" value="" style="margin:0px;" /></td>
                                        <td>Flight Number</td>
                                      </tr>-->
										</table>
									</td>
								</tr>
								<tr style="display:none;">
									<td>
										<strong>Flight Number</strong><br />
										<input name="flight_number" type="text" class="txt-field" value="e.g US775" style="margin-top:5px;" />
									</td>
								</tr>
								<tr>
									<td style="padding-top:8px;"><strong>Order Pickup Time</strong></td>
								</tr>
								<tr>
									<td>
										<select name="pickup_time_hour" class="combowd float-left" style="width:78px; margin-right:10px;">
											<option value="">HH</option>
											<?
                                        for ($i=1;$i<=12;$i++)
										{
										?>
											<option value="<?= $i ?>" <?= ($arrReturn["pickup_time_hour"] == $i) ? 'selected="selected"' : '' ?>>
												<? if($i<10) echo 0;?><?= $i ?>
											</option>
											<?
                                        }
										?>
										</select>
										<select name="pickup_time_minute" class="combowd float-left" style="width:80px; margin-right:10px;">
											<option value="">MM</option>
											<?
                                        for ($i=0;$i<60;$i++)
										{
										?>
											<option value="<?= $i ?>" <?= ($arrReturn["pickup_time_minute"] == $i) ? 'selected="selected"' : '' ?>>
												<? if($i<10) echo 0;?><?= $i ?>
											</option>
											<?
										$i+=4;
                                        }
										?>
										</select>
										<select name="pickup_time_type" class="combowd float-left" style="width:78px;">
											<option value="AM" <?= ($arrReturn["pickup_time_type"] == "AM") ? 'selected="selected"' : '' ?>>AM</option>
											<option value="PM" <?= ($arrReturn["pickup_time_type"] == "PM") ? 'selected="selected"' : '' ?>>PM</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<!--<span class="time">min <em>45min</em> before actual flight time</span>-->
									</td>
								</tr>
								<tr>

									<td>
										<input name="btn" type="submit" class="btn" value="Find Restaurants" />
									</td>
								</tr>
							</table>
							<noscript>
								<strong>Javascript is Disabled. Please Enable Javascript to use Waive's full functionalities.</strong>
							</noscript>
						</div>
					</div>
				</div>
				<!-- End Mid Cont Right -->
			</form>

		</div>

	</div>
	<div class="cont-round"><img src="<?= base_url() ?>images/front/form-bottom.jpg" alt="top" border="0" /></div>
</div>

<?
$this->load->view("userfront/footer_view");
?>