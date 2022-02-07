let startDate = initialStartDate.clone().subtract(29, "days");
let endDate = initialEndDate.clone();
let periodicity = initialPeriodicity;

function daterangeHandler(start, end) {
  startDate = start;
  endDate = end;

  const text = endDate.diff(startDate, "days") > 0
    ? `${start.format("DD MMMM YYYY")} - ${end.format("DD MMMM YYYY")}`
    : start.format("DD MMMM YYYY");

  $(".btn-daterange span").html(text);
}

async function getChartLabelsAndDatasets(url) {
  const response = await fetch(url, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    body: JSON.stringify({
      start_date: startDate.format("YYYY-MM-DD HH:mm:ss"),
      end_date: endDate.format("YYYY-MM-DD HH:mm:ss"),
      periodicity,
    }),
  });

  if (!response.ok) {
    const json = await response.json();

    throw new Error(`[HTTP ${response.status}] ${json.message}`);
  }

  return await response.json();
}

$(function() {
  $(".btn-daterange").daterangepicker({
    ranges: daterangepickerRanges,
    startDate,
    endDate,
    maxDate: moment(),
    locale: {
      applyLabel,
      cancelLabel,
      customRangeLabel,
    },
  }, daterangeHandler);

  daterangeHandler(startDate, endDate);

  $(".btn-daterange").on("cancel.daterangepicker", function (ev, picker) {
    startDate = null;
    endDate = null;

    $(".btn-daterange span").html(customRangeLabel);
  });

  $(".periodicity-dropdown-item").on("click", function() {
    const value = $(this).attr("data-value");
    const label = $(this).html();

    periodicity = value !== '__reset' ? value : null;

    $(".periodicity-dropdown-item").removeClass("active");
    $(this).addClass("active");

    $("#periodicity-dropdown-toggle").html(value !== '__reset' ? label : periodicityLabel);
  });

  const chartElement = document.getElementById("chart").getContext("2d");

  let chart = new Chart(chartElement, {
    type: "bar",
    options: {
      legend: {
        display: false,
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              display: false,
            },
            scaleLabel: {
              display: true,
              labelString: xAxesLabelString,
            },
          },
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false,
              color: "#f2f2f2",
            },
            scaleLabel: {
              display: true,
              labelString: yAxesLabelString,
            },
            ticks: {
              beginAtZero: true,
              stepSize: 150,
            },
          },
        ],
      },
      elements: {
        pointRadius: 4,
      },
    },
  });

  $("button#download-chart").on("click", function () {
    const a = document.createElement("a");

    a.href = chart.toBase64Image();
    a.download = `${moment().format("YYYY-MM-DD")}.png`;

    a.click();
  });

  $("button#load-chart-data").on("click", async function () {
    $(this).attr("disabled", "disabled").addClass("btn-progress");

    try {
      chart.data = await getChartLabelsAndDatasets($(this).attr("data-url"));

      chart.update();
    } catch (error) {
      console.error(error);

      alert(error.message);
    }

    $(this).removeAttr("disabled").removeClass("btn-progress");
  });
});
