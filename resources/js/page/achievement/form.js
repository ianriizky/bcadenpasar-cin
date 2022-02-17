async function updateSelect2Option(url, selected, elementTarget, previousSelected = null) {
  $(elementTarget)
    .attr("disabled", "disabled")
    .find("option")
    .remove()
    .end();

  if (selected == null) {
    return;
  }

  try {
    const options = await $.ajax(`${url}/${selected}`);

    $.each(options, function (index, option) {
      const { value, text } = option;

      $(elementTarget).append($("<option>", { value, text }));
    });

    $(elementTarget)
      .val(previousSelected === null ? nullExpression : previousSelected)
      .removeAttr("disabled");
  } catch (error) {
    alert(error.responseJSON.message);

    console.error(error);
  }
}

$(function () {
  $("#achieved_date").daterangepicker({
    locale: {
      format: dateFormatIso,
    },
    startDate,
    singleDatePicker: true,
    autoApply: true,
    showWeekNumbers: true,
  });

  $("#branch_id").on("change", async function (event) {
    await updateSelect2Option(
      select2Routes.target, $(event.currentTarget).val(),
      "#target_id", selectedTarget
    );

    await updateSelect2Option(
      select2Routes.event, $(event.currentTarget).val(),
      "#event_id", selectedEvent
    );

    await updateSelect2Option(
      select2Routes.user, $(event.currentTarget).val(),
      "#achieved_by", selectedAchievedBy
    );
  });
});
