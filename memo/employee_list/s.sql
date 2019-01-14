-- 社員情報取得
select e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'
from employees as e
join m_departments as md on e.m_dept_id = md.id
join m_jobs as mj on e.m_job_id = mj.id

-- 社員情報取得, 社員名絞り込みありバージョン, 姓のみ
select e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'
from (
	select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, m_dept_id, m_job_id
	from employees
	where name_sei = '佐藤'
) as e
join m_departments as md on e.m_dept_id = md.id
join m_jobs as mj on e.m_job_id = mj.id