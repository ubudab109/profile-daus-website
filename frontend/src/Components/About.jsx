import React from "react";

const About = () => (
    <section id="about" className="about">
        <div className="container">
            <div className="section-title">
                <h2>About</h2>
                <p>
                    Fullstack Engineer with 6+ years of experience building scalable web applications using Laravel, Node.js (NestJS, Express), Vue.js, and React. Strong background in microservices architecture, RESTful APIs, and containerized deployments with Docker. Experienced in CI/CD, PostgreSQL, Redis, and cloud platforms like AWS & DigitalOcean. Passionate about clean code, performance optimization, and end-to-end system design.
                </p>
            </div>

            <div className="row">
                <div
                    className="col-lg-12 pt-4 pt-lg-0 content"
                    data-aos="fade-left"
                >
                    <h3>Software Engineer &amp; Backend Engineer.</h3>
                    <p className="fst-italic">Personal Data</p>
                    <div className="row">
                        <div className="col-lg-6">
                            <ul>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>Birthday:</strong>{" "}
                                    <span>14 October 1999</span>
                                </li>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>Website:</strong>{" "}
                                    <span>rizkydausprofile.site</span>
                                </li>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>Phone:</strong>{" "}
                                    <span>+62 858 8702 8342</span>
                                </li>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>City:</strong>{" "}
                                    <span>Jakarta, Indonesia</span>
                                </li>
                            </ul>
                        </div>
                        <div className="col-lg-6">
                            <ul>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>Age:</strong> <span>25</span>
                                </li>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>Degree:</strong>{" "}
                                    <span>
                                        Bachelor Degree, Information Technology
                                    </span>
                                </li>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>Email:</strong>{" "}
                                    <span>rizkyfirdaus0309@gmail.com</span>
                                </li>
                                <li>
                                    <i className="bi bi-chevron-right"></i>{" "}
                                    <strong>Open To Work:</strong>{" "}
                                    <span>Yes</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
);

export default About;
