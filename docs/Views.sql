MySQL Views

/* VIEW::get_open_request_data */

SELECT r.rid AS id, r.uid AS uid, u.department_id AS depart_id, d.summary AS what, s.status AS status, r.added_on AS `when`, o.uid AS sid FROM help_requests AS r, help_details AS d, help_status AS s, get_support_officers AS o, users AS u WHERE r.rid = d.rid AND d.rid = s.rid AND s.status != "Closed" AND u.department_id = o.did AND u.uid = r.uid

/* VIEW::get_closed_request_data */

SELECT r.rid as rid, u.uid as who, d.summary as what, r.added_on as submitted, c.completed_on as completed, o.uid as `by`, CONCAT(o.first_name," ",o.last_name) as officer FROM help_requests AS r, help_details AS d, help_status AS s, help_complete AS c, users AS u, get_support_officers AS o WHERE r.rid = d.rid AND d.rid = s.rid AND s.rid = c.rid AND r.uid = u.uid AND c.uid = o.uid AND u.department_id = o.did 