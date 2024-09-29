import type { StringLiteral } from "typescript";

export interface CourseProps{
    id?: number;
    instructor_name: string;
    course_offer: string;
    description: string;
    price_before: string;
    price_after: string;
    course_from: any;
    course_to: any;
    course_training?: CourseTrainingProps;
    course_internship?: CourseInternship;
    profile_picture: any;
    created_at?: string;
    updated_at?: string;
}

export interface CourseTrainingProps{
    course_id: number
    what_will_learn?: string[];
    training_process?: string[];
    profile_picture?: any;
}

export interface CourseInternship{
    course_id: number
    lesson_training?: string[];
    profile_picture?: any;
}

export interface PaymentProps{
    id?: number;
    course_id?: number;
    first_name: string;
    middle_name: string;
    last_name: string;
    email: string;
    reference_number?: string;
    contact_number: string; 
    status: string;
}