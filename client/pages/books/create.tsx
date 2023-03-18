import { ChangeEvent, useState } from 'react'

import Image from 'next/image'

import type { NextPage } from 'next'

import { BookFormDataType } from 'features/book/types'
import { axios } from 'libs/axios'

const BookCreateForm: NextPage = () => {
  const [formData, setFormData] = useState<BookFormDataType>({
    title: '',
    description: '',
  })

  const handleChange = (e: ChangeEvent<HTMLInputElement> | ChangeEvent<HTMLTextAreaElement>) => {
    const { name, value } = e.target
    setFormData({ ...formData, [name]: value })
  }
  const createBooks = () => {
    axios.post('/api/books', formData).then((res) => res.data)
  }

  return (
    <>
      <div className='flex items-center justify-center p-5'>
        <div className='w-3/4 overflow-hidden rounded-2xl bg-gray-100 text-gray-500 shadow-xl'>
          <div className='w-full md:flex'>
            <div className='hidden w-1/2 bg-indigo-500 p-7 md:block'>
              <Image src='/images/create.png' alt='logo' width='1000px' height='1300px' />
            </div>
            <div className='w-full py-10 px-5 md:w-1/2 md:px-10'>
              <div className='mb-10 text-center'>
                <h1 className='text-3xl font-bold text-gray-900'>Create</h1>
                <div className='-mx-3 flex'>
                  <div className='my-14 w-full px-3'>
                    <label className='px-2 text-sm font-semibold'>Title</label>
                    <div className='flex'>
                      <div className='pointer-events-none z-10 flex w-10 items-center justify-center pl-1 text-center'>
                        <i className='text-lg text-gray-400'></i>
                      </div>
                      <input
                        name='title'
                        type='text'
                        className='-ml-10 w-full rounded-lg border-2 border-gray-200 py-2 pl-10 pr-3 outline-none focus:border-indigo-500'
                        placeholder='ドメイン駆動設計入門'
                        value={formData.title}
                        onChange={handleChange}
                      />
                    </div>
                  </div>
                </div>
                <div className='-mx-3 flex'>
                  <div className='mb-10 w-full px-3'>
                    <label className='px-1 text-xs font-semibold'>Description</label>
                    <div className='flex'>
                      <div className='pointer-events-none z-10 flex w-10 items-center justify-center pl-1 text-center'>
                        <i className='text-lg text-gray-400'></i>
                      </div>
                      <textarea
                        name='description'
                        className='-ml-10 h-44 w-full resize rounded-lg border-2 border-gray-200 py-2 pl-10 pr-3 outline-none focus:border-indigo-500'
                        placeholder='学習しやすいパターンが満載！ ドメイン駆動設計をやさしく学べる入門書！ 【本書の概要】 本書は、 『エリック・エヴァンスのドメイン駆動設計』（ISBN978-4-7981-2196-3、翔泳社）、 『実践ドメイン駆動設計』（ISBN978-4-7981-3161-0、翔泳社） に感銘を受けた著者が贈る、ドメイン駆動設計の入門書です。 【対象読者】 『エリック・エヴァンスのドメイン駆動設計』や 『実践ドメイン駆動設計』をこれから読もうとしている方、 もしくはすでに読んだものの、「もう少しやさしい入門書も読みたい」 と感じているエンジニアの方を対象としています。 【本書の特徴】 ドメイン駆動設計において、実践が難しいものは後回しにして、 理解しやすい実装パターンからドメイン駆動設計の世界に 飛び込んでもらうことを目的としています。 そこで初心者にとって、理解しやすい、そして実践しやすいパターンからスタートできるよう、 解説を工夫しています。 またドメイン駆動設計で頻出するパターンの記述方法やその目的も併せて解説しています。 本書で解説するパターンは以下のとおりです。 【知識を表現するパターン】 ・値オブジェクト ・エンティティ ・ドメインサービス 【アプリケーションを実現するためのパターン】 ・リポジトリ ・アプリケーションサービス ・ファクトリ 【知識を表現する、より発展的なパターン】 ・集約 ・仕様'
                        value={formData.description}
                        onChange={handleChange}
                      />
                    </div>
                  </div>
                </div>
                <div className='-mx-3 flex'>
                  <div className='mt-12 w-full px-3'>
                    <button
                      className='mx-auto block w-full max-w-xs rounded-lg bg-indigo-500 p-3 font-semibold text-white hover:bg-indigo-700 focus:bg-indigo-700'
                      onClick={createBooks}
                    >
                      Create
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}

export default BookCreateForm
