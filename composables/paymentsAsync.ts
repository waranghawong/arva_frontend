import type { PaymentProps } from "@/utils/types";

export const paymentAsync = <T = PaymentProps>() => {
    const router = useRouter();

    async function insertPayment(credentials: PaymentProps) {
        await $larafetch("/api/payment", { 
          method: "post",
          body: credentials,
          headers: {
            Accept: "application/json",
          },
         });
      };

    const fetchPayments = async <T = PaymentProps>() => {
      try {
        return await $larafetch<T>("/api/payment");
      } catch (error: any) {
        if ([401, 419].includes(error?.response?.status)) return null;
        throw error;
      }
    };


    return {
      insertPayment,
      fetchPayments
    };
}