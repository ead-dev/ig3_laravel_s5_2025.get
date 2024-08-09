import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'
import inscriptions from './routes/inscriptions';
import filieres from './routes/filieres';
import matieres from './routes/matieres';
import salles from './routes/salles';
import laboratoires from './routes/laboratoires';
import etudiants from './routes/etudiants';
import tuteurs from './routes/tuteurs';
import livres from './routes/livres';
import enseignants from './routes/enseignants';
import programmes from './routes/programmes';
import tranches from './routes/tranches';
import emplois from './routes/emplois';
import annees from './routes/annees';
import tarifs from './routes/tarifs';
import ecolages from './routes/ecolages';
import evaluations from './routes/evaluations';
import examens from './routes/examens';
import criteres from './routes/criteres'
import posts from './routes/posts'

/* Guest Component */
import Login from '@/Components/Central/Auth/Login.vue';
import Profile from '@/Components/Central/Auth/Profile.vue';
import SuperDashboard from '@/Components/Central/Super/Dashboard.vue'
import TeacherDashboard from '@/Components/Teacher/Dashboard.vue'
import Report from '@/Components/Exports/Report.vue';
import ReportStudent from '@/Components/Pages/Reports/Student.vue';
import ReportMonth from '@/Components/Pages/Reports/Month.vue';
import ReportFiliere from '@/Components/Pages/Reports/Student.vue';
import ReportTeacher from '@/Components/Pages/Reports/Teacher.vue';

const dashboards = [
    {
        'role_id':1,
        'component':SuperDashboard
    },
    {
        'role_id':2,
        'component':TeacherDashboard
    },
];




const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Connexion`
        }
    },

    {
        name: "profile",
        path: "/me",
        component: Profile,
        meta: {
            middleware: "auth",
            title: `Profil`
        }
    },

    {
        name: "home",
        path: "/",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },

    ...inscriptions,
    ...filieres,
    ...salles,
    ...matieres,
    ...laboratoires,
    ...etudiants,
    ...tuteurs,
    ...livres,
    ...enseignants,
    ...programmes,
    ...tranches,
    ...emplois,
    ...annees,
    ...tarifs,
    ...ecolages,
    ...evaluations,
    ...examens,
    ...criteres,
    ...posts,

    //Routes du super Administrateur
    {
        name: "dashboard",
        path: '/dashboard',
        component:SuperDashboard,
        meta: {
            title: `Admin Dashboard`,
            middleware: "auth",
            guard:'admin'
        }
    },
    {
        name: "prof_dashboard",
        path: '/prof/dashboard',
        component:TeacherDashboard,
        meta: {
            title: `Teableau de bord`,
            middleware: "auth",
            guard:'prof'
        }
    },

    {
        name: "report",
        path: '/report',
        props: true,
        component: Report,
        meta: {
            title: `Rapport`,
            middleware: "auth"
        }
    },
    {
        name: "report_student",
        path: '/reports/students',
        props: true,
        component: ReportStudent,
        meta: {
            title: `Rapport`,
            middleware: "auth"
        }
    },
    {
        name: "report_month",
        path: '/reports/month',
        props: true,
        component: ReportMonth,
        meta: {
            title: `Rapport`,
            middleware: "auth"
        }
    },
    {
        name: "report_filiere",
        path: '/reports/filiere',
        props: true,
        component: ReportFiliere,
        meta: {
            title: `Rapport`,
            middleware: "auth"
        }
    },
    {
        name: "report_teacher",
        path: '/reports/teacher',
        props: true,
        component: ReportTeacher,
        meta: {
            title: `Rapport`,
            middleware: "auth"
        }
    },

]

const router = createRouter({
    history: createWebHistory(),
    mode:'history',
   // hash:true,
    routes, // short for `routes: routes`
})

router.beforeEach(async(to, from, next) =>{
    document.title = to.meta.title
    if(to.meta.middleware == "guest"){
        console.log(from.path);
        if(store.state.user==null){
            next();
        }else{
            next({name:"dashboard"})
        }
    }
    if(to.meta.middleware == "auth"){
        if(store.state.user==null){
            next({name:"login"});
        }
    }
    //await store.dispatch();
    /* if (to.meta.middleware == "guest") {
        if (store.state.authenticated) {
            next({ name: "super_dashboard" })
        }
        next()
    } else {
        if(to.meta.middleware=="auth"){
            if (!store.state.authenticated) {
                next({ name: "login" })
            }
            next()
        }
        next()
    } */
    next()
})

export default router
