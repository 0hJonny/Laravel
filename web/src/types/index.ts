/* TODO: раскидать по файлам */

/* Пользователь */
export interface LoginResponse {
  token: string
  user: User
}

export interface User {
  user_name: string
  email: string
}

/* Сущность Reader */
export interface Reader {
  reader_id: number
  reader_user_id: number
  reader_name: string
  reader_surname: string
  reader_middle_name: string | null
  created_at: string | null
  updated_at: string | null
}

/* Сущность Loan */
export interface Loan {
  loan_id: number
  loan_copy_id: number
  loan_reader_id: number
  loan_date: string
  loan_return_date: string | null
  loan_return_date_plan: string
  created_at: string | null
  updated_at: string | null
}

/* Сущность Publication */
export interface Publication {
  publication_id: number
  publication_title: string
  publication_author: string
  publication_publisher: string
  publication_date: string
  publication_page: number
  publication_ISBN: string
  publication_publication_language: number
  created_at: string | null
  updated_at: string | null
}
