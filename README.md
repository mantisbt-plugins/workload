# Workload
[Manstis BT](http://www.mantisbt.org/) Plugin based on selected custom fields to compute project workload.

## Installation
TBD

## Requirements
1. Plugin for 1.2.10 and above
2. Allow user to report work progression percentage :
	1. According to bug status
	2. Directly in bug summary or in bug update form (no extra view)
3. Allow user to fill estimated / done workload :
	1. According to bug status
	2. In different numeric format (minutes, hours, days...)
	3. Directly in bug summary or in bug update form (no extra view)
4. Build workload / overload report per :
	1. Project
	2. Version
	3. Issue handler
5. Follow changes in bug history

## Technical solution
Solution is based on MantisBT [custom fields feature](https://www.mantisbt.org/docs/master-1.2.x/en/administration_guide/admin.customize.html).
In plugin configuration, user must select/configure :
- Three custom fields of type NUMERIC :
    - One for work progression
    - One for estimated workload
	- One for done workload
- Percentage of higher remaining work to warn about
- Issue status threshold to warn about higher remaining work
- Percentage of lower progress to warn about
- Issue status threshold to warn about undefined test
