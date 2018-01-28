## Releases
<div>
	<ul class="posts">
		{% for post in site.posts %}
		<li>
			<span>{{ post.date | date_to_string }} : </span>
			<a href="https://mantisbt-plugins.github.io/workload{{ post.url }}" title="{{ post.title }}">{{ post.title }}</a>
		</li>
		{% endfor %}
	</ul>
</div>
<div>
	<p style="margin:0;">Releases with major version number equal to 2 are targeted for MantisBT 1.3.12 and above.</p>
	<p style="margin:0;">Releases with major version number equal to 3 are targeted for MantisBT 2.3.0 and above.</p>
</div>

## Features
<ul>
	<li>
		<span>Estimate your issue workload and achievement rate</span>
		<img alt="Issue Workload" 
			src="https://mantisbt-plugins.github.io/workload/assets/issue_custom_field_2_3_X.png" 
			title="Issue workload in MantisBT 2.3.X" />
	</li>
	<li>
		<span>Assess the remaining workload and achievement rates of your projects</span>
		<img alt="Workload analysis" 
			src="https://mantisbt-plugins.github.io/workload/assets/workload_analysis_2_3_X.png" 
			title="Workload analysis in MantisBT 2.3.X" />
	</li>
</ul>

## RSS feed
<div>
<a href="https://mantisbt-plugins.github.io/workload/atom.xml">RSS feed</a>
</div>