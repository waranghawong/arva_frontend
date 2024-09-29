export type Students = {
    name: string;
    email?: string;
    course_offer?: string;
    course_from?: string;
    course_to?: string;
    instructor_name?: string;
};

export const studentAsync = <T = Students>() => {
    
    const fetchStudents = async <T = PaymentProps>() => {
        try {
          return await $larafetch<T>("/api/students");
        } catch (error: any) {
          if ([401, 419].includes(error?.response?.status)) return null;
          throw error;
        }
    };

    return {
        fetchStudents
    };

}