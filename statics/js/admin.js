/**
 * 后台管理列表全选
 * 
 * @param isChecked
 * @param checkboxItemName
 */
function zAdminListCheckAll(isChecked, checkboxItemName) {
	var eleList = document.getElementsByName(checkboxItemName);
	for (i in eleList) {
		eleList[i].checked = isChecked;
	}
}