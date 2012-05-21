var DefaultActiveMarker = "ActiveDepartment";
var CurrentActiveDepartment = "none";
var CurrentFocusDepartment;
var DefaultDisplayZone = "MoodleDisplay";

function setDisplayZone(strDisplayId)
{
	DefaultDisplayZone = strDisplayId;
}

function MoodleDepartmentList(DepartmentMarker)
{
	CurrentFocusDepartment = document.getElementById(DepartmentMarker.getAttribute('rel'));
	if(CurrentActiveDepartment != "none")
	{
		CurrentActiveDepartment.removeAttribute('id');
	}
	DepartmentMarker.setAttribute('id', DefaultActiveMarker);
	CurrentActiveDepartment = DepartmentMarker;
	document.getElementById(DefaultDisplayZone).innerHTML = CurrentFocusDepartment.innerHTML;
	
}
