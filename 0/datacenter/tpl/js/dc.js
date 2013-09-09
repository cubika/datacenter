function draw(divId, chart, data, width, height) {
	var c = new FusionCharts(chart, "chart_" + divId, width, height);
	c.setJSONData(data);
	c.render(divId);
}