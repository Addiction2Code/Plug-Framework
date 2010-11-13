function showContent(vThis)
{
	vParent = vThis.parentNode;
	vSibling = vParent.nextSibling;
	while (vSibling.nodeType==3) // Fix for Mozilla/FireFox Empty Space becomes a TextNode or Something
	{
		vSibling = vSibling.nextSibling;
	};
	if(vSibling.style.display == "none")
	{
		vThis.src="resources/images/collapse.gif";
		vThis.alt = "Hide Div";
		vSibling.style.display = "block";
	}
	else
	{
		vSibling.style.display = "none";
		vThis.src="resources/images/expand.gif";
		vThis.alt = "Show Div";
	}
	return;
}


