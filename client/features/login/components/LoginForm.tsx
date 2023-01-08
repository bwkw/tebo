import { FC } from 'react'

import { Spacer } from '@nextui-org/react'
import { FaKey } from 'react-icons/fa'
import { HiOutlineMail } from 'react-icons/hi'

import { OnClickButton } from 'components/elements/button/OnClickButton'
import { IconUnderlineDefaultInput } from 'components/elements/input/IconUnderlineDefaultInput'
import { IconUnderlineDefaultPasswordInput } from 'components/elements/input/IconUnderlineDefaultPasswordInput'

export const LoginForm: FC = () => {
  return (
    <div className='h-full w-screen'>
      <Spacer y={5.0} />
      <div className='mx-auto bg-navy box-border h-1/2 w-1/5 p-4 rounded border border-gray-400 text-center p-10'>
        <Spacer y={1.0} />
        <IconUnderlineDefaultInput icon={HiOutlineMail} placeholder='Email' />
        <Spacer y={2.0} />
        <IconUnderlineDefaultPasswordInput icon={FaKey} placeholder='Password' />
        <Spacer y={3.0} />
        <OnClickButton color={'#5435A9'} text={'Login'} />
      </div>
    </div>
  )
}
