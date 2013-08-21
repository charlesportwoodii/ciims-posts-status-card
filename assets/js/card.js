var dASaghwDa = {

	 id : null,

	 target : null,

	 self : null,

	 load : function(id) {
	 	this.id = id;
	 	this.target = "#dASaghwDa[data-attr-id='" + this.id + "']";
	 	self = this;

	 	$.get(CiiDashboard.endPoint + "/card/callmethod/id/" + this.id + "/method/getPosts", function(data) {
	 		Morris.Donut({
			  element: self.id + "-chart",
			  colors: data.colors,
			  data: data.data
			});

	 	});
	 }
}