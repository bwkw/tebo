import { FC } from 'react'

import { Input } from '@nextui-org/react'

import { IconInputType } from 'types/input'

export const IconUnderlineDefaultPasswordInput: FC<IconInputType> = ({ icon: Icon, placeholder }) => {
  return (
    <>
      <Input.Password
        color='default'
        contentLeft={<Icon className='text-white' />}
        underlined
        placeholder={placeholder}
      />
    </>
  )
}
