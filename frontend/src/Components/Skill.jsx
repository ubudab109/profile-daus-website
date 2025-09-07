import React from 'react';
import ProgressBar from 'react-bootstrap/ProgressBar';

const Skill = ({ skills }) => {
	return (
		<section id="skills" className="skills section-bg">
			<div className="container">

				<div className="section-title">
					<h2>Skills</h2>
				</div>

				<div className="row skills-content">
					
					{
						skills.map(data => (
							<div className="col-lg-6" data-aos="fade-up" key={data.id}>
								<div className="progress">
									<span className="skill">{data.name} <i className="val">{data.percentage}%</i></span>
									<div className="progress-bar-wrap">
										<ProgressBar now={data.percentage} />
									</div>
								</div>
							</div>
						))
					}
				</div>
			</div>
		</section>
	);
};

export default Skill;
