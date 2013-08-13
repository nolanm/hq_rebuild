

function create_new_job(id) {
	
        if($('#title'+id).val()=='')
        {
            alert("Job title is a required field.");
        }
        else
        {
            
            var restaurants;
            var distribution;

            if($('#radioall'+id).is(':checked'))
            {
               restaurants= $('#allstores'+id).val();
            }
            else if($('#radiostores'+id).is(':checked'))
            {
                restaurants= $('#stores'+id).val();
            }
            else if($('#radiodist'+id).is(':checked'))
            {
                distribution= $('#distlist'+id).val();
            }
            
            var type;
            if($('#type0'+id).is(':checked'))
            {
                type=0;
            }
            else if($('#type1'+id).is(':checked'))
            {
                type=1;
            }
            else if($('#type2'+id).is(':checked'))
            {
                type=2;
            }
        
            $.ajax({
                    type: 'post',
                    url: 'create_job',
                    data: { title: $('#title'+id).val(), hours: $('#hours'+id).val(),
                        payrange: $('#payrange'+id).val(), type: type,
                        description: $('#description'+id).val(), benefits: $('#benefits'+id).val(), edit_job: $('#edit_job'+id).val(),
                        restaurants: restaurants, distribution: distribution
                        }, 
                    success: function (html) {

                        if(html=='')
                        {
                            location.reload();
                        }
                        
                    }   
                  });
        }

}

function new_crew_job_template(x)
{
    $('#newCrewJobTemplate').show();
    defaultJobs(0, x);
    
}

function hide_crew_job_template()
{
    $('#newCrewJobTemplate').hide();
}

function new_mgmt_job_template(x)
{
    $('#newMgmtJobTemplate').show();
    defaultJobs(1, x);
    
}

function hide_mgmt_job_template()
{
    $('#newMgmtJobTemplate').hide();
}

function job_template_changed(id)
{
    var x = $('#jobTemplate'+id).val();
   
    if(x>=0)
    {
        defaultJobs(id, x);
    }
}

function delete_job(id, type) {
	// insert the new job and create assignments
	if (confirm("Are you sure you want to delete this job?")) {
		$.ajax({
                    type: 'post',
                    url: 'delete_job',
                    data: {id: id, type:type}, 
                    success: function (html) {
                       location.reload();
                     }   
                  });
	}
}

function update_job(id) {
	
        if($('#title'+id).val()=='')
        {
            alert("Job title is a required field.");
        }
        else
        {
            
            var restaurants;
            var distribution;

            if($('#radioall'+id).is(':checked'))
            {
               restaurants= $('#allstores'+id).val();
            }
            else if($('#radiostores'+id).is(':checked'))
            {
                restaurants= $('#stores'+id).val();
            }
            else if($('#radiodist'+id).is(':checked'))
            {
                distribution= $('#distlist'+id).val();
            }
            
            var type;
            if($('#type0'+id).is(':checked'))
            {
                type=0;
            }
            else if($('#type1'+id).is(':checked'))
            {
                type=1;
            }
            else if($('#type2'+id).is(':checked'))
            {
                type=2;
            }
        
            $.ajax({
                    type: 'post',
                    url: 'update_job',
                    data: { id: id, title: $('#title'+id).val(), hours: $('#hours'+id).val(),
                        payrange: $('#payrange'+id).val(), type: type,
                        description: $('#description'+id).val(), benefits: $('#benefits'+id).val(), edit_job: $('#edit_job'+id).val(),
                        restaurants: restaurants, distribution: distribution
                        }, 
                    success: function (html) {
                        //alert(html);
                        $('#update_alert'+id).html(html);
                        
                    }   
                  });
        }
	
}

function unassign_all_restaurants(jobid, jobtype)
{
    if (confirm("Are you sure you want to remove the assignments from this job?"))
        {
        $.ajax({
            type: 'post',
            url: 'unassign_restaurants', 
            data: { jobid: jobid, type: jobtype}, 
            success: function (html) {
                location.reload();
            }   
          });
        }
}

function update_assignment(jobid, restaurantid)
{
    
    if($('#checbox-'+jobid+'-'+restaurantid).is(':checked'))
    {
        var checked=TRUE;
    }
    else
    {
        var checked=FALSE;
    }
    $.ajax({
                    type: 'post',
                    url: 'update_assignment', 
                    data: { jobid: jobid, restaurantid: restaurantid, checked: checked }, 
                    success: function (html) {
                        //alert(html);
                        $('#update_alert'+id).html(html);
                        
                    }   
                  });
    
}

function distListUpdate(id, type)
{
    if($('#distlist'+id).val() >0)
    {
        $.ajax({
            type: 'post',
            url: 'distribution_list_alert', 
            data: { distribution_list: $('#distlist'+id).val(), job_type: type}, 
            success: function (html) {
                $('#distribution_alert'+id).html(html);
            }   
          });
    }
    else
    {
        $('#distribution_alert'+id).html('');
    }
    
}

function distListDisplay(id) {
    restaurantsdiv = 'restaurants_' + id;
    distributiondiv = 'distribution_' + id;
    if($('#radioall'+id).is(':checked'))
    {
        $('#'+restaurantsdiv).hide();
        $('#'+distributiondiv).hide();
    }
    else if($('#radiostores'+id).is(':checked'))
    {
        $('#'+restaurantsdiv).show();
        $('#'+distributiondiv).hide();
    }
    else if($('#radiodist'+id).is(':checked'))
    {
        $('#'+restaurantsdiv).hide();
        $('#'+distributiondiv).show();
    }
}

function defaultJobs(id, x) {
   
   
    if(x<16)
    {
        $('#title'+id).attr("disabled",true);
        $('#description'+id).attr("disabled",true);
        $('#benefits'+id).attr("disabled",true);
        $('#type'+id).attr("disabled",true);
        $('#overview'+id).attr("disabled",true);
    }
    else
    {
        $('#title'+id).removeAttr("disabled");
        $('#description'+id).removeAttr("disabled");
        $('#benefits'+id).removeAttr("disabled");
        $('#type'+id).removeAttr("disabled");
        $('#overview'+id).removeAttr("disabled");
        
    }
    
    $('#title'+id).val(jobTitle[x]);
    $('#hours'+id).val(jobHours[x]);
    $('#payrange'+id).val(jobPayRange[x]);
    $('#description'+id).val(jobDescription[x]);
    $('#overview'+id).val(jobOverview[x]);
    $('#benefits'+id).val(jobBenefits[x]);
    $('#edit_job'+id).val(edit_job[x]);
    $('#type'+jobType[x]+id).prop('checked', 'checked');
          
	
}


var jobTitle = new Array();
var jobHours = new Array();
var jobPayRange = new Array();
var jobType = new Array();
var jobOverview= new Array();
var jobDescription = new Array();
var jobBenefits = new Array();
var edit_job= new Array();

// DEAFULT MGMT JOB
jobTitle[0] = "Management";
jobHours[0] = "";
jobPayRange[0] = "";
jobType[0] = 1;
jobOverview[0]='';
jobDescription[0] = 'More experience. More opportunity.  More success.  It\'s all in a day\'s work when you\'re running your own multi-million dollar restaurant as a McDonald\'s Manager.  Start today. You\'ll manage people.  Streamline processes.  And even provide front-line for managers who have the energy to lead the charge. If you\'re an energetic and driven individual with supervisory or management experience in a restaurant, retail or hospitality environment, we want to meet you!  Apply online and see what your future can hold.';
jobBenefits[0] = 'Got what it takes? Then join the team! We offer a long list of good things like: Flexible schedules, training and development programs, advancement opportunities, uniforms, and much more! See Restaurant Manager for details.';
edit_job[0]=0;

// DEFAULT MGMT JOB - SPANISH
jobTitle[1] = "Gerentes";
jobHours[1] = "";
jobPayRange[1] = "";
jobType[1] = 1;
jobOverview[1]='';
jobDescription[1] = "Más experiencia. Más oportunidad.  Más éxito.  Todo esto es parte del trabajo diario cuando administra su propio restaurante de varios millones de dólares como Gerente de McDonald´s.  Comience hoy. Usted manejará a un equipo de personas.  Agilizará procesos.  Y hasta les brindará apoyo directamente a los gerentes que tienen la energía de dirigir la carga. Si usted es una persona con energía e impulso y con experiencia en supervisión o manejo de un restaurante, comercio o ambiente hospitalario, ¡queremos conocerte! Aplique en línea y vea lo que su futuro le puede ofrecer.";
jobBenefits[1] = "¿Tiene lo que se necesita? Entonces, ¡únase al equipo! Ofrecemos una larga lista de beneficios, como horarios flexibles, uniformes gratis y programas de entrenamiento y desarrollo. También ofrecemos oportunidades de ser promovido y ¡mucho más! Consulte al Gerente del restaurante para obtener más detalles.";
edit_job[1]=0;

// DEFAULT CREW JOB
jobTitle[2] = "Crew";
jobHours[2] = "";
jobPayRange[2] = "";
jobType[2] = 0;
jobOverview[2]='';
jobDescription[2] = 'This is it!  It\'s time you worked for someone who will give you the tools to learn, grow and be what you want to be - both personally and professionally. We\'re looking for hard working, enthusiastic individuals who want to be a part of a winning team.  If you enjoy working with people and love to learn new things, we want to meet you.  We offer flexible schedules and the opportunity to advance within our restaurants. Got what it takes?  Apply online and see what your future can hold.';
jobBenefits[2] = 'Got what it takes? Then join the team! We offer a long list of good things like: Flexible schedules, training and development programs, advancement opportunities, uniforms, and much more! See Restaurant Manager for details.';
edit_job[2]=0;

// DEFAULT CREW JOB - SPANISH
jobTitle[3] = "Miembro de equipo";
jobHours[3] = "";
jobPayRange[3] = "";
jobType[3] = 0;
jobOverview[3]='';
jobDescription[3] = "¡Éste es!  Llegó el momento de trabajar para alguien que le dará las herramientas para aprender, crecer y ser lo que desea, tanto personal como profesionalmente. Estamos buscando a personas trabajadoras y entusiastas que deseen formar parte de un equipo ganador.  Si usted le gusta trabajar con gente  y le gusta aprender cosas nuevas, queremos conocerle.   Ofrecemos horarios flexibles y la oportunidad de ser promovido dentro de nuestros restaurantes. ¿Tiene lo que buscamos ?  Aplique en línea y vea lo que su futuro le puede ofrecer.";
jobBenefits[3] = "¿Tiene lo que se necesita? Entonces, ¡únase al equipo! Ofrecemos una larga lista de beneficios, como: horarios flexibles, uniformes gratis, y programas de entrenamiento y desarrollo. También ofrecemos oportunidades de ser promovido y ¡mucho más! Consulte al Gerente del restaurante para obtener más detalles.";
edit_job[3]=0;

// DEFAULT ZONE MGMT JOB
jobTitle[4] = "Zone Management";
jobHours[4] = "";
jobPayRange[4] = "";
jobType[4] = 1;
jobOverview[4]='';
jobDescription[4] = 'We know what it\'s like to be a leader.  That\'s why we provide you with the opportunities to reach your goals, enjoy a successful career and be at the top of your game! The challenges are immense.  The pay-off is even greater.  And the hands-on experience you\'ll get is unlike anything - anywhere.  As a Zone Manager, you\'ll touch every part of our business.  From Front Counter Manager to Grill Manager, each step of our career ladder is designed to maximize your professional growth and long-term success. If you\'re an energetic and driven individual with supervisory or management experience in a restaurant, retail or hospitality environment, we want to meet you!  Apply online and see what your future can hold.';
jobBenefits[4] = 'Got what it takes? Then join the team! We offer a long list of good things like: Flexible schedules, training and development programs, advancement opportunities, uniforms, and much more! See Restaurant Manager for details.';
edit_job[4]=0;

// DEFAULT ZONE MGMT JOB - SPANISH
jobTitle[5] = "Gerentes de Zona";
jobHours[5] = "";
jobPayRange[5] = "";
jobType[5] = 1;
jobOverview[5]='';
jobDescription[5] = "Sabemos lo que se siente ser un líder.  ¡Es por eso que le brindamos la oportunidad de alcanzar sus metas, disfrutar de una carrera exitosa y ser el mejor del grupo ! Los desafíos son enormes.  El resultado es aún mayor.  Y la experiencia práctica que obtendrá no se iguala en ningún lugar.  Como Gerente de zonas, tendrá contacto con cada parte de nuestro negocio.  Desde Gerente del mostrador hasta Gerente de la parrilla, cada puesto está diseñado para aumentar su crecimiento profesional y su éxito a largo plazo. De esta manera, también avanza en su carrera profesional con nosotros. Si usted es una persona con energía e impulso y con experiencia en supervisión o manejo en un restaurante, comercio o ambiente hospitalario, ¡queremos conocerte!  Aplique en línea y vea lo que su futuro le puede ofrecer.";
jobBenefits[5] = "¿Tiene lo que se necesita? Entonces, ¡únase al equipo! Ofrecemos una larga lista de beneficios, como horarios flexibles, uniformes gratis y programas de entrenamiento y desarrollo. También ofrecemos oportunidades de ser promovido y ¡mucho más! Consulte al Gerente del restaurante para obtener más detalles.";
edit_job[5]=0;

// Beverage Specialist/Crew Trainer – McCafé
jobTitle[6] = "Beverage Specialist/Crew Trainer";
jobHours[6] = "";
jobPayRange[6] = "";
jobType[6] = 0;
jobOverview[6]='';
jobDescription[6] = 'This is it!  It\'s time you worked for someone who will give you the tools to learn, grow and be what you want to be - both personally and professionally. We\'re looking for enthusiastic individuals who want to be a part of a winning team.  As a beverage specialist, in addition to being a member of our winning crew, you will prepare the McCafé station, troubleshoot equipment issues, conduct product sampling, and train McDonald\'s crew members on the preparation of our high-quality McCafé beverages, to the customers’ expectations.  You will assist in delivering quality product, along with the great service and value that McDonald\'s is known for. If you enjoy working with people and love to learn new things, we want to meet you.  We offer flexible schedules and the opportunity to advance within our restaurants. Got what it takes?  Apply online and see what your future can hold.';
jobBenefits[6] = "Got what it takes? Then join the team! We offer a long list of good things like: Flexible schedules, training and development programs, advancement opportunities, uniforms, and much more! See Restaurant Manager for details.";
edit_job[6]=0;

// Beverage Specialist/Crew Trainer – McCafé - SPANISH
jobTitle[7] = "Entrenador de empleados/especialista en bebidas";
jobHours[7] = "";
jobPayRange[7] = "";
jobType[7] = 0;
jobOverview[7]='';
jobDescription[7] = "¡Éste es!  Llegó el momento de trabajar para alguien que le dará las herramientas para aprender, crecer y ser lo que desea, tanto personal como profesionalmente. Estamos buscando a personas trabajadoras y entusiastas que deseen formar parte de un equipo ganador.  Como especialista en bebidas, además de ser miembro de nuestro equipo triunfador, preparará el puesto de McCafé, revisará los fallos de la maquinaria, entregará muestras de productos y entrenará a los empleados \"crew\" de McDonald's en la preparación de las bebidas de alta calidad de McCafé, para cumplir las expectativas de los clientes.  Usted ayudará a entregar productos de alta calidad y a ofrecer el servicio y el valor por los que McDonald's es reconocido. Si usted le gusta trabajar con gente  y le gusta aprender cosas nuevas, queremos conocerle.   Ofrecemos horarios flexibles y la oportunidad de ser promovido dentro de nuestros restaurantes. ¿Tiene lo que buscamos?  Aplique en línea y vea lo que su futuro le puede ofrecer.";
jobBenefits[7] = "¿Tiene lo que se necesita? Entonces, ¡únase al equipo! Ofrecemos una larga lista de beneficios, como: horarios flexibles, uniformes gratis, y programas de entrenamiento y desarrollo. También ofrecemos oportunidades de ser promovido y ¡mucho más! Consulte al Gerente del restaurante para obtener más detalles.";
edit_job[7]=0;

// Crew Member – McCafé
jobTitle[8] = "McCafé Crew Member";
jobHours[8] = "";
jobPayRange[8] = "";
jobType[8] = 0;
jobOverview[8]='';
jobDescription[8] = "This is it!  It's time you worked for someone who will give you the tools to learn, grow and be what you want to be - both personally and professionally. We're looking for enthusiastic individuals who want to be a part of a winning team. In addition to being a member of our winning crew, you will get the opportunity to be a part of our exciting McCafé beverage line.  From answering customers’ questions, to preparation of our McCafé beverages, you will be on the front line delivering exceptional customer service. If you enjoy working with people and love to learn new things, we want to meet you.  We offer flexible schedules and the opportunity to advance within our restaurants. Got what it takes?  Apply online and see what your future can hold.";
jobBenefits[8] = "Got what it takes? Then join the team! We offer a long list of good things like: Flexible schedules, training and development programs, advancement opportunities, uniforms, and much more! See Restaurant Manager for details.";
edit_job[8]=0;

// Crew Member – McCafé - SPANISH
jobTitle[9] = "McCafé Miembro de equipo";
jobHours[9] = "";
jobPayRange[9] = "";
jobType[9] = 0;
jobOverview[9]='';
jobDescription[9] = "¡Éste es!  Llegó el momento de trabajar para alguien que le dará las herramientas para aprender, crecer y ser lo que desea, tanto personal como profesionalmente.  Estamos buscando a personas trabajadoras y entusiastas que deseen formar parte de un equipo ganador. Además de ser uno de nuestros empleados triunfadores, tendrá la oportunidad de ser parte del equipo de la línea de bebidas de McCafé.  Usted estará al frente ofreciendo un servicio excepcional al cliente, con actividades que van desde responder las preguntas de los clientes hasta preparar las bebidas de McCafé. Si usted le gusta trabajar con gente  y le gusta aprender cosas nuevas, queremos conocerle. Ofrecemos horarios flexibles y la oportunidad de ser promovido dentro de nuestros restaurantes. ¿Tiene lo que buscamos?  Aplique en línea y vea lo que su futuro le puede ofrecer.";
jobBenefits[9] = "¿Tiene lo que se necesita? Entonces, ¡únase al equipo! Ofrecemos una larga lista de beneficios, como: horarios flexibles, uniformes gratis, y programas de entrenamiento y desarrollo. También ofrecemos oportunidades de ser promovido y ¡mucho más! Consulte al Gerente del restaurante para obtener más detalles.";
edit_job[9]=0;

// Management – McCafé
jobTitle[10] = "McCafé Manager";
jobHours[10] = "";
jobPayRange[10] = "";
jobType[10] = 1;
jobOverview[10]='';
jobDescription[10] = "More experience. More opportunity. More success. It's all in a day's work as a McDonald's Manager. Start today. In addition to being part of the management team, you may have the opportunity to lead the team serving our high quality McCafé beverages.  You will select team members, coordinate scheduling, and coach people at all levels in the restaurant. You’ll streamline processes and even provide front-line hands-on support. We're changing the way we do business and we're looking for managers to lead the charge. If you're an energetic and driven individual with supervisory or management experience in a restaurant, retail or hospitality environment, we want to meet you! Apply online and see what your future can hold.";
jobBenefits[10] = "Got what it takes? Then join the team! We offer a long list of good things like: Flexible schedules, training and development programs, advancement opportunities, uniforms, and much more! See Restaurant Manager for details.";
edit_job[10]=0;

// Management – McCafé - SPANISH
jobTitle[11] = "Gerente McCafé";
jobHours[11] = "";
jobPayRange[11] = "";
jobType[11] = 1;
jobOverview[11]='';
jobDescription[11] = "Más experiencia. Más oportunidad.  Más éxito.  Todo esto es parte del trabajo diario cuando administra su propio restaurante de varios millones de dólares como Gerente de McDonald´s.  Comience hoy. Además de ser parte del equipo de gerencia, puede tener la oportunidad de dirigir al equipo para servir nuestras bebidas de alta calidad de McCafé.  Usted seleccionará a los miembros del equipo, coordinará los horarios y dará coaching a la gente en todos los niveles del restaurante. Usted optimizará los procesos y puede ayudar a los empleados que atienden a los clientes. Estamos cambiando la manera en que hacemos negocios y buscamos a gerentes que sean líderes en este cambio. Si usted es una persona con energía e impulso y con experiencia en supervisión o manejo en un restaurante, comercio o ambiente hospitalario, ¡queremos conocerte!  Aplique en línea y vea lo que su futuro le puede ofrecer.";
jobBenefits[11] = "¿Tiene lo que se necesita? Entonces, ¡únase al equipo! Ofrecemos una larga lista de beneficios, como horarios flexibles, uniformes gratis y programas de entrenamiento y desarrollo. También ofrecemos oportunidades de ser promovido y ¡mucho más! Consulte al Gerente del restaurante para obtener más detalles.";
edit_job[11]=0;

// Flexible Opportunities
jobTitle[12] = "Flexible Opportunities!";
jobHours[12] = "";
jobPayRange[12] = "";
jobType[12] = 1;
jobOverview[12]='';
jobDescription[12] = "We believe in flexibility and team work! Whether you are looking to supplement your income, rejoin the workforce, or start your career, McDonald's offers flexible restaurant job opportunities. McDonald's provides flexible scheduling for those whose availability is limited to a few hours per week.";
jobBenefits[12] = "Working at McDonald's will provide a wealth of experience and skills including time management, customer service, team building, problem solving, self-confidence, responsibility and more. McDonald's is an equal opportunity employer committed to an inclusive and diverse workforce.";
edit_job[12]=0;

// Flexible Opportunities
jobTitle[13] = "Flexible Breakfast Opportunities!";
jobHours[13] = "";
jobPayRange[13] = "";
jobType[13] = 1;
jobOverview[13]='';
jobDescription[13] = "We believe in flexibility! McDonald's is offering flexible restaurant job opportunities during breakfast hours. Get the restaurant off to a great start! Join our team during our busy breakfast shift to assist in serving our customers.";
jobBenefits[13] = "Working at McDonald's will provide a wealth of experience and skills including time management, customer service, team building, problem solving, self-confidence, responsibility and more. McDonald's is an equal opportunity employer committed to an inclusive and diverse workforce. McDonald's is an equal opportunity employer committed to an inclusive and diverse workforce.";
edit_job[13]=0;

// Flexible Opportunities
jobTitle[14] = "Flexible Lunch Opportunities!";
jobHours[14] = "";
jobPayRange[14] = "";
jobType[14] = 1;
jobOverview[14]='';
jobDescription[14] = "We believe in flexibility! McDonald's offers flexible restaurant job opportunities during lunch hours. Do you want to work in a fast-paced environment for the leader in the industry?";
jobBenefits[14] = "Working at McDonald's will provide a wealth of experience and skills including time management, customer service, team building, problem solving, self-confidence, responsibility and more. McDonald's is an equal opportunity employer committed to an inclusive and diverse workforce. McDonald's is an equal opportunity employer committed to an inclusive and diverse workforce.";
edit_job[14]=0;

// Flexible Opportunities
jobTitle[15] = "Flexible Dinner Opportunities!";
jobHours[15] = "";
jobPayRange[15] = "";
jobType[15] = 1;
jobOverview[15]='';
jobDescription[15] = "We believe in flexibility! McDonald's offers flexible restaurant job opportunities during dinner hours. You get the chance to help our customers end their day end on a good note.";
jobBenefits[15] = "Working at McDonald's will provide a wealth of experience and skills including time management, customer service, team building, problem solving, self-confidence, responsibility and more. McDonald's is an equal opportunity employer committed to an inclusive and diverse workforce. McDonald's is an equal opportunity employer committed to an inclusive and diverse workforce.";
edit_job[15]=0;

jobTitle[16] = "";
jobHours[16] = "";
jobPayRange[16] = "";
jobType[16] = 1;
jobOverview[16]='';
jobDescription[16] = "";
jobBenefits[16] = "";
edit_job[16]=1;