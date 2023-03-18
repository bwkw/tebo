export type FetchBookType = {
  id: number
  title: string
  description: string
  cover_image_url: string
  page: number
  published_date: Date
  created_at: Date
  updated_at: Date
  authors: string[]
  publisher: string
}

export type BookIndexType = {
  books: FetchBookType[]
}

export type BookType = {
  book: FetchBookType
}

export type BookFormDataType = {
  title: string
  description: string
}
