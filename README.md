# Workload
Manstis BugTracker (http://www.mantisbt.org/) Plugin based on selected numeric custom fields to compute project workload.

## Requirements
1. Plugin for 1.2.10 and above
2. Allow user to fill estimated / done workload :
(2.1) According to bug status
(2.2) In different numeric format (minutes, hours, days...)
(2.3) Directly in bug summary or in bug update form (no extra view)
3. Build workload / overload report per :
(3.1) Project
(3.2) Version
(3.3) Issue handler
4. Follow changes in bug history

## Technical solution
Solution is based on MantisBT custom fields feature (http://www.mantisbt.org/manual/manual.customizing.mantis.custom.fields.php).
In plugin configuration, user must select two custom fields of type NUMERIC :
  - One for estimated workload
  - One for done workload

## Other MantisBT plugins related to project management
- TimeCard (https://github.com/mantisbt-plugins/timecard)
- TimeTracking (https://github.com/mantisbt-plugins/timetracking)
- Project Management (https://github.com/vincentsels/ProjectManagement)