<?php
#TABS
include 'forms.php';
include 'intros.php';

$TABS['contact']=array(
					'attr'	=> array(
								'class'	=> 'ums'
								),
					'nav'	=> array(
								'message'	=> array('i'=>'fa fa-edit',
													 'text'=> array('class'	=> false,
													 				'content' => 'Contactar'
													 				)
													 ),
								'login'  	=> array('i'=>'fa fa-sign-in',
													 'text'=> array('class' => 'hidden-xxs',
																	'content'	=> 'Iniciar sesion'
																	)
													),
								'signup'	=> array('i'=>'fa fa-user-plus',
													 'text'=> array('class' => 'hidden-xxs',
																	'content'	=> 'Registrarse'
																	)
													 )
								),
					'tab'	=> array(
								'message' => '',
								'login'   => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['login'], 
																'links'	=> array(
																		'label'		=> 'Conectarse con :',
																		'facebook'	=> $LINKS['login_facebook'],
																		'twitter'	=> $LINKS['login_twitter']
																			)
																)
														)
											),
								'signup'  => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['signup'], 
																'links'	=> array(
																		'facebook'	=> $LINKS['signup_facebook'],
																		'twitter'	=> $LINKS['signup_twitter']
																			)
																)
														)
											)
								)
					);
$TABS['comment']=array(
					'attr'	=> array(
								'class'	=> 'ums'
								),
					'nav'	=> array(
								'comment'	=> array('i'=>'fa fa-edit',
													 'text'=> array('class'	=> false,
													 				'content' => 'Comentar'
													 				)
													 ),
								'login'  	=> array('i'=>'fa fa-sign-in',
													 'text'=> array('class' => 'hidden-xxs',
																	'content'	=> 'Iniciar sesion'
																	)
													),
								'signup'	=> array('i'=>'fa fa-user-plus',
													 'text'=> array('class' => 'hidden-xxs',
																	'content'	=> 'Registrarse'
																	)
													 )
								),
					'tab'	=> array(
								'comment' => '',
								'login'   => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['login'], 
																'links'	=> array(
																		'label'		=> 'Conectarse con :',
																		'facebook'	=> $LINKS['login_facebook'],
																		'twitter'	=> $LINKS['login_twitter']
																			)
																)
														)
											),
								'signup'  => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['signup'], 
																'links'	=> array(
																		'facebook'	=> $LINKS['signup_facebook'],
																		'twitter'	=> $LINKS['signup_twitter']
																			)
																)
														)
											)
								)
					);
$TABS['user_comment']=array(
					'attr'	=> array(
								'class'	=> 'ums'
								),
					'nav'	=> array(
								'comment'	=> array('i'=>'fa fa-edit',
													 'text'=> array('class'	=> false,
													 				'content' => 'Comentar'
													 				)
													 ),
								'logout'  	=> array(
													'class'=>'pull-right',
													'i'=>'fa fa-sign-in',
													'text'=> array('class' => 'hidden-xxs',
																	'content'	=> 'Cerrar sesión'
																	)
													)
								),
					'tab'	=> array(
								'comment' => array(
												'media'=> array(
															'left' => array(
                                                    					'img' => array(
                                                                			'src'   => '',
                                                                			'class' => 'profile-pic',
                                                                			'alt'   => ''
                                                                					)
                                                        					),
                                        					'body' => array(
                                                    					'heading'=>array(
                                                                			'text' => array(
                                                                            		'tag' => 'b',
                                                                            		'content'=> ''
                                                                             				)
                                                                    				)
                                                    					),
                                                			'right' => false
                                                			)
                                        			)
									)
					);
$TABS['comment_reply']=array(
							'attr' 	=> '',
							'nav'	=> array(
											'like'	=> array(
														'i'		=> 'fa fa-thumbs-o-up',
														'text'	=> array(
																	'class'	=> 'hidden-xs',
																	'tag'	=> 'span',
																	'content' => 'Me gusta'
																		)
															),
											'reply'	=> array(
														'i'	=> 'fa fa-reply',
														'text'=> array(
																	'class'	=> 'hidden-xs',
																	'tag'	=> 'span',
																	'content' => 'Responder'
																	)

															),
											'responses'=>array(
														'i' => 'fa fa-comments-o',
														'text'	=> array(
																	'class'	=> 'hidden-xs',
																	'tag'	=> 'span',
																	'content' => 'Respuestas'
																	)
															)
											),
							'tab'	=> array(
											'reply' => '',
											'responses'=>''
											)
					);
$TABS['comment_reply_v1']=array(
							'attr' 	=> '',
							'nav'	=> array(
											'like'	=> array(
														'i'		=> 'fa fa-thumbs-up'
															),
											'dislike'	=> array(
														'i'		=> 'fa fa-thumbs-down'
															),
											'reply'	=> array(
														'i'	=> 'fa fa-reply',
														'text'=> array(
																	'class'	=> 'hidden-xs',
																	'tag'	=> 'span',
																	'content' => 'Responder'
																	)

															),
											'responses'=>array(
														'i' => 'fa fa-comments-o',
														'text'	=> array(
																	'class'	=> 'hidden-xs',
																	'tag'	=> 'span',
																	'content' => 'Respuestas'
																	)
															)
											),
							'tab'	=> array(
											'reply' => '',
											'responses'=>''
											)
					);
$TABS['profile']=array(
					'attr'		=> array(
								'class'	=> 'ums'
								),
					'nav'	=> array(
								'login'  	=> array('i'=>'fa fa-sign-in',
													 'text'=> array('class' => false,
																	'content'	=> 'Iniciar sesión'
																	)
													 ),
								'signup'	=> array('i'=>'fa fa-user-plus',
													 'text'=> array('class' => false,
																	'content'	=> 'Registrarse'
																	)
													 )
								),
					'tab'	=> array(
								'login'   => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['login'], 
																'links'	=> array(
																		'label'		=> 'Conectarse con :',
																		'facebook'	=> $LINKS['login_facebook'],
																		'twitter'	=> $LINKS['login_twitter']
																			)
																)
														)
											),
								'signup'  => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['signup'], 
																'links'	=> array(
																		'facebook'	=> $LINKS['signup_facebook'],
																		'twitter'	=> $LINKS['signup_twitter']
																			)
																)
														)
											)
								)
					);