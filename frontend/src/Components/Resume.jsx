import React from "react";
import PropTypes from "prop-types";

const Resume = ({ experiences }) => {
    return (
        <section id="resume" className="resume">
            <div className="container">
                <div className="section-title">
                    <h2>Resume</h2>
                </div>
                <div className="row">
                    <div className="col-lg-12" data-aos="fade-up">
                        <h3 className="resume-title">Education</h3>
                        <div className="resume-item">
                            <h4>Bachelor Degree, Information Technology</h4>
                            <h5>2017 - 2021</h5>
                            <p>
                                <em>Trilogi University, Jakarta, Indonesia</em>
                            </p>
                            <div>
                                <ul>
                                    <li>
                                        Graduated 'With honors' and GPA of
                                        3.49/4.00
                                    </li>
                                    <li>
                                        Organization: Developer Student Club
                                    </li>
                                    <li>
                                        Publications: Object Detections using
                                        CNN and Yolov3 on Institute of
                                        Electrical and Electronics Engineers{' '}
										<a href="https://ieeexplore.ieee.org/document/10053004" rel="noreferrer" target="_blank">(Link)</a>
                                    </li>
									<li>
                                        Publications: Deep Learning (Object Clasification)
                                        Using Convolutional Neural Network{' '}
										<a href="https://openjournal.unpam.ac.id/index.php/informatika/article/view/8556" rel="noreferrer" target="_blank">(Link)</a>
                                    </li>
                                    <li>
                                        Other Activities: Assistant Lecture in
                                        Algorithm Programming
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div
                        className="col-lg-12"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        <h3 className="resume-title">
                            Professional Experience
                        </h3>
                        {experiences.map((data, key) => (
                            <div className="resume-item" key={key}>
                                <h4>{data.title}</h4>
                                <p>
                                    <em> {data.company} </em>
                                </p>
                                <h5>
                                    {data.start_date} -{" "}
                                    {data.end_date ?? "Present"}
                                </h5>
                                <p>
                                    <em> {data.location} </em>
                                </p>
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: data.desc,
                                    }}
                                />
                                {data.stack.map((item, index) => (
                                    <span
                                        className="badge bg-secondary"
                                        style={{ marginRight: "3px" }}
                                        key={index}
                                    >
                                        {item}
                                    </span>
                                ))}
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
};

Resume.propTypes = {
    experiences: PropTypes.array.isRequired,
};

export default Resume;
