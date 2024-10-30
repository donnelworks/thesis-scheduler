// Scrollbar
var scrollbar = $(".scrollbar").overlayScrollbars({
	className: "os-theme-thin-dark",
	resize: "none",
	sizeAutoCapable: true,
	paddingAbsolute: true,
	overflowBehavior: {
		x: "hidden",
	},
	scrollbars: {
		visibility: "auto",
		autoHide: "leave",
		autoHideDelay: 800,
		clickScrolling: true,
	},
});