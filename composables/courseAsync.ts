import type { CourseProps } from "@/utils/types";

export const courseAsync = <T = CourseProps>() => {
    const router = useRouter();

    async function refresh() {
      try {
       await fetchCurrentUser();
      } catch {
        
      }
    }

    async function insertCourse(credentials: CourseProps) {
      await $larafetch("/api/course", { 
        method: "post",
        body: credentials,
        headers: {
          Accept: "application/json",
        },
       });
       await refresh();
    };

    async function deleteCourse(id: string) {
  
      await $larafetch(`/api/course/${id}`, { method: "delete" });
      location.reload();
      // await router.push("/");
    }

    async function updateCourse(credentials: CourseProps) {
      await $larafetch(`/api/course/`, { 
        method: "put",
        body: credentials,
        headers: {
          Accept: "application/json",
        },
       });
       await refresh();
    };

    const fetchCourses = async <T = CourseProps>() => {
      try {
        return await $larafetch<T>("/api/course");
      } catch (error: any) {
        if ([401, 419].includes(error?.response?.status)) return null;
        throw error;
      }
    };

    const allCourses = async <T = CourseProps>() => {
      try {
        return await $larafetch<T>("/api/all_course");
      } catch (error: any) {
        if ([401, 419].includes(error?.response?.status)) return null;
        throw error;
      }
    };

    const latestCourse = async <T = CourseProps>() => {
      try {
        return await $larafetch<T>("/api/popular_courses");
      } catch (error: any) {
        if ([401, 419].includes(error?.response?.status)) return null;
        throw error;
      }
    };

    const featuredCourse = async <T = CourseProps>() => {
      try {
        return await $larafetch<T>("/api/featured_course");
      } catch (error: any) {
        if ([401, 419].includes(error?.response?.status)) return null;
        throw error;
      }
    };

    const getCourseTitle = async <T = CourseProps>() => {
      try {
        return await $larafetch<T>("/api/courses_title");
      } catch (error: any) {
        if ([401, 419].includes(error?.response?.status)) return null;
        throw error;
      }
    };

    


    return {
      insertCourse,
      fetchCourses,
      deleteCourse,
      updateCourse,
      refresh,
      latestCourse,
      getCourseTitle,
      allCourses,
      featuredCourse
    };
}